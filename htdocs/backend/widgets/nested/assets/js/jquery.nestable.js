;(function ($) {
    var defaults = {
        listNodeName: 'ul',
        itemNodeName: 'li',
        expandBtnHTML: '<button data-action="expand" class="nested" type="button"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></button>',
        collapseBtnHTML: '<button data-action="collapse" class="nested" type="button"><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></button>',
    };

    function Plugin(element, options) {
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function () {
            var list = this;

            $.each(this.el.find(list.options.itemNodeName), function (k, el) {
                list.setParent($(el));
            });

            $.each(this.el.find('.preview'), function (k, el) {
                $(el).click(function () {
                    var value = $(this).siblings('.new-label-input').val()
                    var number = $(this).siblings('.show-label').find('.number').text()
                    $(this).siblings('.show-label').empty().append('<b class="number">' + number + '</b>' + value)
                });
            });

            list.el.on('click', 'button', function (e) {
                var target = $(e.currentTarget),
                    action = target.data('action'),
                    item = target.parent(list.options.itemNodeName);
                if (action === 'collapse') {
                    list.collapseItem(item);
                }
                if (action === 'expand') {
                    list.expandItem(item);
                }
            });
        },

        expandItem: function (li) {
            li.children('[data-action="expand"]').hide();
            li.children('[data-action="collapse"]').show();
            li.children(this.options.listNodeName).show();
        },

        collapseItem: function (li) {
            var lists = li.children(this.options.listNodeName);
            if (lists.length) {
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }
        },

        setParent: function (li) {
            if (li.children(this.options.listNodeName).length) {
                li.prepend($(this.options.expandBtnHTML));
                li.prepend($(this.options.collapseBtnHTML));
            }
            li.children('[data-action="expand"]').hide();
        }
    };

    $.fn.nestable = function (params) {
        var lists = this;

        lists.each(function () {
            var plugin = $(this).data("nestable");

            if (!plugin) {
                $(this).data("nestable", new Plugin(this, params));
                $(this).data("nestable-id", new Date().getTime());
            }
        });

        return lists;
    };

})(window.jQuery || window.Zepto, window, document);
