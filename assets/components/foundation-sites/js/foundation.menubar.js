!function(Foundation, $) {
  'use strict';

  // The plugin matches the plugin classes with these plugin instances.
  var menubarPlugins = {
    dropdown: {
      cssClass: 'dropdown',
      plugin: Foundation._plugins['dropdown-menu'] || null
    },
    drilldown: {
      cssClass: 'drilldown',
      plugin: Foundation._plugins['drilldown'] || null
    },
    accordion: {
      cssClass: 'accordion-menu',
      plugin: Foundation._plugins['accordion-menu'] || null
    }
  }

  // [PH] Media queries
  var phMedia = {
    small: '(min-width: 0px)',
    medium: '(min-width: 640px)'
  }

  /**
   * Creates a new instance of a responsive menu.
   * @class
   * @fires MenuBar#init
   * @param {jQuery} element - jQuery object to make into a dropdown menu.
   * @param {Object} options - Overrides to the default plugin settings.
   */
  function MenuBar(element) {
    this.$element = $(element);
    this.rules = this.$element.data('menu-bar');
    this.currentMq = null;
    this.currentPlugin = null;

    this._init();
    this._events();

    /**
     * Fires when the plugin has been successfuly initialized.
     * @event MenuBar#init
     */
     this.$element.trigger('init.zf.menubar');
  }

  MenuBar.defaults = {};

  /**
   * Initializes the menu bar by parsing the classes from the 'data-menubar' attribute on the element.
   * @function
   * @private
   */
  MenuBar.prototype._init = function() {
    var rulesTree = {};

    // Parse rules from "classes" in data attribute
    var rules = this.rules.split(' ');

    // Iterate through every rule found
    for (var i = 0; i < rules.length; i++) {
      var rule = rules[i].split('-');
      var ruleSize = rule.length > 1 ? rule[0] : 'small';
      var rulePlugin = rule.length > 1 ? rule[1] : rule[0];

      if (menubarPlugins[rulePlugin] !== null) {
        rulesTree[ruleSize] = menubarPlugins[rulePlugin];
      }
    }

    this.rules = rulesTree;

    if (!$.isEmptyObject(rulesTree)) {
      this._checkMediaQueries();
    }
  };

  /**
   * Initializes events for the menu bar.
   * @function
   * @private
   */
  MenuBar.prototype._events = function() {
    var _this = this;

    $(window).on('resize.zf.menubar', function() {
      _this._checkMediaQueries();
    });
  };

  /**
   * Checks the current screen width against available media queries. If the media query has changed, and the plugin needed has changed, the plugins will swap out.
   * @function
   * @private
   */
  MenuBar.prototype._checkMediaQueries = function() {
    var matchedMq, _this = this;

    // Iterate through each rule and find the last matching rule
    $.each(this.rules, function(key, value) {
      if (window.matchMedia(phMedia[key]).matches && key !== _this.currentMq) {
        matchedMq = key;
      }
    });

    // No match? No dice
    if (!matchedMq) return;

    // Plugin already initialized? We good
    if (this.currentPlugin instanceof this.rules[matchedMq].plugin) return;

    // Remove existing plugin-specific CSS classes
    $.each(menubarPlugins, function(key, value) {
      _this.$element.removeClass(value.cssClass);
    });

    // Add the CSS class for the new plugin
    this.$element.addClass(this.rules[matchedMq].cssClass);

    // Create an instance of the new plugin
    if (this.currentPlugin) this.currentPlugin.destroy();
    this.currentPlugin = new this.rules[matchedMq].plugin(this.$element, {});
  }

  /**
   * Destroys the instance of the current plugin on this element, as well as the window resize handler that switches the plugins out.
   * @function
   */
  MenuBar.prototype.destroy = function() {
    this.currentPlugin.destroy();
    $(window).off('.zf.menubar');
  }
  // MenuBar.prototype.DropdownMenu = Foundation.DropdownMenu;
  Foundation.plugin(MenuBar);

}(Foundation, jQuery)
