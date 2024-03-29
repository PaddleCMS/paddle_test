/**
 * @file
 * Overrides active_tags.js, specifically overrides Drupal.behaviors.activeTagsAdd
 * with alterations to prevent duplicate terms being added to the dialog.
 */

(function ($) {

var activeTags = {};

activeTags.parseCsv = function (string, sep) {
  for (var result = string.split(sep = sep || ","), x = result.length - 1, tl; x >= 0; x--) {
    if (result[x].replace(/"\s+$/, '"').charAt(result[x].length - 1) == '"') {
      if ((tl = result[x].replace(/^\s+"/, '"')).length > 1 && tl.charAt(0) == '"') {
        result[x] = result[x].replace(/^\s*"|"\s*$/g, '').replace(/""/g, '"');
      }
      else if (x) {
        result.splice(x - 1, 2, [result[x - 1], result[x]].join(sep));
      }
      else {
        result = result.shift().split(sep).concat(result);
      }
    }
    else {
      result[x].replace(/""/g, '"');
    }
  }
  return result;
};

activeTags.checkEnter = function (event) {
  if (event.keyCode == 13) {
    $('#autocomplete').each(function () {
      this.owner.hidePopup();
    });

    $(this).parent().find('.at-add-btn').click(function () {
      event.preventDefault();
      return false;
    });
  }
};

activeTags.addTerms = function (context, terms) {
  terms = activeTags.parseCsv(terms);
  for (i in terms) {
    activeTags.addTerm(context, terms[i]);
  }
};

activeTags.addTerm = function (context, term) {
  // Hide the autocomplete drop down.
  $('#autocomplete').each(function () {
    this.owner.hidePopup();
  });

  // Removing all HTML tags. Need to wrap in tags for text() to work correctly.
  term = $('<div>' + term + '</div>').text();
  term = Drupal.checkPlain(term);
  term = jQuery.trim(term);

  if (term != '') {
    var terms = term.split(',');
    var termDiv = $(context);
    var termList = termDiv.parent().find('.at-term-list');
    for (var i = 0; i < terms.length; i++) {
      termList.append(Drupal.theme('activeTagsTermRemove', terms[i]));
    }
    // Attach behaviors to new DOM content.
    Drupal.attachBehaviors(termList);
    activeTags.updateFormValue(termList);
    termList.parent().find('.at-term-entry').val('');
  }

  return false;
};

activeTags.removeTerm = function (context) {
  var tag = $(context);
  var termList = tag.parent();
  tag.remove();
  activeTags.updateFormValue(termList);
};

activeTags.updateFormValue = function (termList) {
  var tags = '';
  termList.find('.at-term-text').each(function (i) {
    // Get tag and revome quotes to prevent doubling
    var tag = $(this).text().replace(/["]/g, '');
    // Wrap in quotes if tag contains a comma.
    if (tag.search(',') != -1) {
      tag = '"' + tag + '"';
    }
    // Collect tags as a comma seperated list.
    tags = (i == 0) ? tag : tags + ', ' + tag;
  });
  // Set comma seperated tags as value of form field.
  termList.parent().find('input.at-terms').val(tags);
};

/**
 * Theme a selected term.
 */
Drupal.theme.prototype.activeTagsTermRemove = function (term) {
  return '<div class="at-term at-term-remove"><span class="at-term-text">' + term + '</span><span class="at-term-action-remove">x</span></div> ';
};

Drupal.behaviors.activeTagsOnEnter = {
  attach: function (context, settings) {
    if ($.browser.mozilla) {
      $('.at-term-entry:not(.activeTagsOnEnter-processed)')
        .addClass('activeTagsOnEnter-processed')
        .keypress(activeTags.checkEnter);
    }
    else {
      $('.at-term-entry:not(.activeTagsOnEnter-processed)')
        .addClass('activeTagsOnEnter-processed')
        .keydown(activeTags.checkEnter);
    }
  }
};

Drupal.behaviors.activeTagsRemove = {
  attach: function (context, settings) {
    $('div.at-term-remove:not(.activeTagsRemove-processed)', context)
      .addClass('activeTagsRemove-processed')
      .each(function () {
        $(this).click(function () {
          activeTags.removeTerm(this);
        })
      });
  }
};

Drupal.behaviors.activeTagsAdd = {
  attach: function (context, settings) {
    $('input.at-add-btn:not(.activeTagsAdd-processed)', context)
      .addClass('activeTagsAdd-processed')
      .each(function () {
        $(this).click(function (e) {
          // Find term and upper case first letter.
          var tag = $(this).parent().find('.at-term-entry').val().replace(/["]/g, '');
          var tag = tag.charAt(0).toUpperCase() + tag.slice(1);
          var string_to_compare = tag.toLowerCase();

          // Create an array of terms which have already been tagged.
          var tags = [];
          var termDiv = $(this);
          var termList = termDiv.parent().find('.at-term-list');
          termList.find('.at-term-text').each(function (i) {
            // Get tag and revome quotes to prevent doubling.
            // Additional upper case first letter.
            var term = $(this).text().replace(/["]/g, '');
            var term = term.charAt(0).toUpperCase() + term.slice(1);
            tags.push(term);

            // If it finds a duplicate prevent the tag from being added
            // to the array.
            var match_string = term.toLowerCase();
            if (string_to_compare == match_string) {
              // Apply css to highlight matched terms.
              $(this).parent().css({ background: "#FFFF00" });
              tags = null;
              // Exit each function.
              return false;
            }
            else {
              $(this).parent().css({ background: "" });
            }
          });

          // If tags is null we must return false to prevent duplicate terms from
          // being added.
          if (tags === null) {
            return false;
          }

          if (Drupal.settings.activeTags.mode === 'csv') {
            activeTags.addTerms(this, tag);
          }
          else {
            // Default to single tag entry mode.
            activeTags.addTerm(this, tag);
          }

          return false;
        });
      });
  }
};

})(jQuery);
