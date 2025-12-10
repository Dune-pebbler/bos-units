jQuery(document).ready(function ($) {
  if (!$('.unit-explorer').length) {
    return;
  }

  const $modal = $('#unit-modal');
  const $modalBody = $('#unit-modal-body');
  const $modalClose = $('#unit-modal-close');
  const $modalOverlay = $('.unit-modal-overlay');
  const $tooltip = $('#unit-tooltip');
  const $tooltipContent = $('#unit-tooltip-content');

  const $buildings = $('.unit-explorer-map svg g[id^="Nummer_"]');

  let unitsData = typeof unitExplorerData !== 'undefined' ? unitExplorerData : {};

  if (Object.keys(unitsData).length > 0) {
    applyUnitStatuses(unitsData);
  } else {
    loadAllUnitsInfo();
  }

  $buildings.each(function () {
    const $building = $(this);
    const buildingId = $building.attr('id');

    $building.addClass('unit-building');

    $building.on('click', function () {
      const unitNumber = buildingId.replace('Nummer_', '');
      loadUnitData(unitNumber);
    });

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

  function applyUnitStatuses(units) {
    Object.keys(units).forEach(function (unitNumber) {
      const unit = units[unitNumber];
      const status = unit.status;
      const $building = $('#Nummer_' + unitNumber);

      if ($building.length && status) {
        $building.removeClass('status-vrij status-voorbehoud status-verkocht');
        $building.addClass('status-' + status);
      }
    });
  }

  function loadUnitData(unitNumber) {
    $modalBody.html('<div class="loading">Loading...</div>');
    openModal();

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

  function displayUnitData(unit) {
    let html = '';

    const hasImage = unit.featured_image && unit.featured_image.length > 0;
    const contentClass = hasImage ? 'unit-modal-content-split' : '';

    if (hasImage) {
      html += '<div class="unit-modal-image">';
      html += '<img src="' + unit.featured_image + '" alt="Unit ' + unit.bouwnummer + '">';
      html += '</div>';
    }

    html += '<div class="unit-modal-info ' + contentClass + '">';

    html += '<h2>Unit ' + unit.bouwnummer + '</h2>';

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

    if (unit.prijs && unit.status !== 'verkocht') {
      html += '<div class="unit-info-item">';
      html += '<span class="label">Prijs:</span>';
      html += '<span class="value">€ ' + formatPrice(unit.prijs) + '</span>';
      html += '</div>';
    }

    html += '</div>';

    if (unit.status !== 'verkocht') {
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
    }

    html += '</div>';

    $modalBody.html(html);
  }

  function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  function openModal() {
    $modal.addClass('active');
    $('body').css('overflow', 'hidden');
  }

  function closeModal() {
    $modal.removeClass('active');
    $('body').css('overflow', '');
  }

  $modalClose.on('click', closeModal);
  $modalOverlay.on('click', closeModal);

  $(document).on('keydown', function (e) {
    if (e.key === 'Escape' && $modal.hasClass('active')) {
      closeModal();
    }
  });

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
          applyUnitStatuses(unitsData);
        }
      }
    });
  }

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

    if (unit.prijs && unit.status !== 'verkocht') {
      html += '<div class="tooltip-item">€ ' + formatPrice(unit.prijs) + '</div>';
    }

    $tooltipContent.html(html);
    $tooltip.addClass('active');
  }

  function hideTooltip() {
    $tooltip.removeClass('active');
  }

  function updateTooltipPosition(e) {
    const offset = 15;
    $tooltip.css({
      left: e.clientX + offset + 'px',
      top: e.clientY + offset + 'px'
    });
  }
});
