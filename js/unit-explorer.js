/**
 * Unit Explorer - Interactive SVG Map
 */

jQuery(document).ready(function ($) {
  // Only run if unit-explorer exists on the page
  if (!$('.unit-explorer').length) {
    return;
  }

  const $modal = $('#unit-modal');
  const $modalBody = $('#unit-modal-body');
  const $modalClose = $('#unit-modal-close');
  const $modalOverlay = $('.unit-modal-overlay');
  const $tooltip = $('#unit-tooltip');
  const $tooltipContent = $('#unit-tooltip-content');

  // Find all building groups in the SVG
  const $buildings = $('.unit-explorer-map svg g[id^="Nummer_"]');

  // Cache for unit data
  let unitsData = {};

  // Load all unit statuses and apply colors
  loadUnitStatuses();

  // Load all units info for tooltips
  loadAllUnitsInfo();

  // Make buildings clickable
  $buildings.each(function () {
    const $building = $(this);
    const buildingId = $building.attr('id');

    // Add interactive classes
    $building.addClass('unit-building');

    // Click handler
    $building.on('click', function () {
      // Extract building number from ID (e.g., "Nummer_10" -> "10")
      const unitNumber = buildingId.replace('Nummer_', '');
      loadUnitData(unitNumber);
    });

    // Tooltip on hover
    $building.on('mouseenter', function () {
      const unitNumber = buildingId.replace('Nummer_', '');
      showTooltip(unitNumber);
    });

    $building.on('mousemove', function (e) {
      updateTooltipPosition(e);
    });

    $building.on('mouseleave', function () {
      hideTooltip();
    });
  });

  // Load unit statuses and apply colors to SVG
  function loadUnitStatuses() {
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'get_all_unit_statuses'
      },
      success: function (response) {
        if (response.success) {
          const statuses = response.data;

          // Apply status classes to each building
          Object.keys(statuses).forEach(function (unitNumber) {
            const status = statuses[unitNumber];
            const $building = $('#Nummer_' + unitNumber);

            if ($building.length) {
              // Remove any existing status classes
              $building.removeClass('status-vrij status-voorbehoud status-verkocht');
              // Add the current status class
              $building.addClass('status-' + status);
            }
          });
        }
      }
    });
  }

  // Load unit data via AJAX
  function loadUnitData(unitNumber) {
    // Show loading state
    $modalBody.html('<div class="loading">Loading...</div>');
    openModal();

    // AJAX request to get unit data
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'get_unit_data',
        unit_number: unitNumber
      },
      success: function (response) {
        if (response.success) {
          displayUnitData(response.data);
        } else {
          $modalBody.html('<div class="error">Unit niet gevonden</div>');
        }
      },
      error: function () {
        $modalBody.html('<div class="error">Er is een fout opgetreden</div>');
      }
    });
  }

  // Display unit data in modal
  function displayUnitData(unit) {
    let html = '';

    // Add class for layout if image exists
    const hasImage = unit.featured_image && unit.featured_image.length > 0;
    const contentClass = hasImage ? 'unit-modal-content-split' : '';

    // Featured image (left side)
    if (hasImage) {
      html += '<div class="unit-modal-image">';
      html += '<img src="' + unit.featured_image + '" alt="Unit ' + unit.bouwnummer + '">';
      html += '</div>';
    }

    // Content wrapper (right side or full width)
    html += '<div class="unit-modal-info ' + contentClass + '">';

    // Title
    html += '<h2>Unit ' + unit.bouwnummer + '</h2>';

    // Unit info
    html += '<div class="unit-info">';

    if (unit.status) {
      const statusLabels = {
        'vrij': 'Beschikbaar',
        'voorbehoud': 'In optie',
        'verkocht': 'Verkocht'
      };
      html += '<div class="unit-info-item">';
      html += '<span class="label">Status:</span>';
      html += '<span class="value status-badge status-' + unit.status + '">' + statusLabels[unit.status] + '</span>';
      html += '</div>';
    }

    if (unit.oppervlakte) {
      html += '<div class="unit-info-item">';
      html += '<span class="label">Oppervlakte:</span>';
      html += '<span class="value">' + unit.oppervlakte + ' m²</span>';
      html += '</div>';
    }

    if (unit.prijs) {
      html += '<div class="unit-info-item">';
      html += '<span class="label">Prijs:</span>';
      html += '<span class="value">€ ' + formatPrice(unit.prijs) + '</span>';
      html += '</div>';
    }

    html += '</div>';

    // Downloads section
    const downloads = [];
    if (unit.download_brochure) downloads.push({ label: 'Brochure', url: unit.download_brochure });
    if (unit.download_ingetekende_plattegrond) downloads.push({ label: 'Ingetekende Plattegrond', url: unit.download_ingetekende_plattegrond });
    if (unit.download_plattegrond) downloads.push({ label: 'Plattegrond', url: unit.download_plattegrond });
    if (unit.download_technische_omschrijving) downloads.push({ label: 'Technische Omschrijving', url: unit.download_technische_omschrijving });
    if (unit.download_inschrijflijst) downloads.push({ label: 'Inschrijflijst', url: unit.download_inschrijflijst });

    if (downloads.length > 0) {
      html += '<div class="unit-downloads">';
      html += '<h3>Downloads</h3>';
      html += '<ul class="download-list">';

      downloads.forEach(function (download) {
        html += '<li><a href="' + download.url + '" target="_blank">' + download.label + '</a></li>';
      });

      html += '</ul>';
      html += '</div>';
    }

    // Close unit-modal-info wrapper
    html += '</div>';

    $modalBody.html(html);
  }

  // Format price with thousand separators
  function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  // Modal functions
  function openModal() {
    $modal.addClass('active');
    $('body').css('overflow', 'hidden');
  }

  function closeModal() {
    $modal.removeClass('active');
    $('body').css('overflow', '');
  }

  // Close modal handlers
  $modalClose.on('click', closeModal);
  $modalOverlay.on('click', closeModal);

  // Close on ESC key
  $(document).on('keydown', function (e) {
    if (e.key === 'Escape' && $modal.hasClass('active')) {
      closeModal();
    }
  });

  // Load all units info for tooltips
  function loadAllUnitsInfo() {
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'get_all_units_info'
      },
      success: function (response) {
        if (response.success) {
          unitsData = response.data;
        }
      }
    });
  }

  // Show tooltip with unit info
  function showTooltip(unitNumber) {
    const unit = unitsData[unitNumber];

    if (!unit) {
      return;
    }

    let html = '';
    html += '<div class="tooltip-item"><strong>Unit ' + unit.bouwnummer + '</strong></div>';

    if (unit.status) {
      const statusLabels = {
        'vrij': 'Beschikbaar',
        'voorbehoud': 'In optie',
        'verkocht': 'Verkocht'
      };
      html += '<div class="tooltip-item">';
      html += '<span class="tooltip-badge status-' + unit.status + '">' + statusLabels[unit.status] + '</span>';
      html += '</div>';
    }

    if (unit.oppervlakte) {
      html += '<div class="tooltip-item">' + unit.oppervlakte + ' m²</div>';
    }

    if (unit.prijs) {
      html += '<div class="tooltip-item">€ ' + formatPrice(unit.prijs) + '</div>';
    }

    $tooltipContent.html(html);
    $tooltip.addClass('active');
  }

  // Hide tooltip
  function hideTooltip() {
    $tooltip.removeClass('active');
  }

  // Update tooltip position to follow cursor
  function updateTooltipPosition(e) {
    const offset = 15;
    $tooltip.css({
      left: e.clientX + offset + 'px',
      top: e.clientY + offset + 'px'
    });
  }
});
