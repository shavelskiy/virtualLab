;(function ($) {
    var defaults = {
        newItem: '<li class="nested-item" data-id="3" data-num="{lastNum}"><p class="show-label"><b class="number">{parentNum}.{lastNum} </b></p>' +
            '<div class="content"></div><div class="settings"><textarea class="form-control mt-2 new-label-input" name="task[{type}][{parentId}][items][new][{sort}][name]"></textarea>' + '' +
            '<textarea class="form-control mt-2 new-content-input" name="task[{type}][{parentId}][items][new][{sort}][content]"></textarea>{components}' +
            '<button type="button" class="btn btn-primary mb-3 mt-2 preview">Предосмотр</button><button type="button" class="btn btn-danger mb-3 mt-2 ml-2 delete-new-item">Удалить</button></div></li>',

        newTask: '<li class="nested-item" data-id="1" data-num="{number}"><h3 class="show-label"><b class="number">{number}. </b></h3>' +
            '<div class="settings"><textarea class="form-control mt-2 new-label-input"></textarea><button type="button" class="btn btn-primary mb-3 mt-2 preview">Предосмотр</button></div>' +
            '<ul class="nested-list" data-count="1">{newItem}<button type="button" class="btn btn-success mb-3 mt-2 new-item">Добавить задание</button></ul><hr></li>',

        components: ''
    };

    function Plugin(element, options) {
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function () {
            var list = this;

            $.ajax({
                url: '/frontend/web/lab/components/',
                success: function (data) {
                    var components = JSON.parse(data);
                    var html = '<select class="form-control mt-2" name="task[{type}][{parentId}][items][new][{sort}][component]"><option></option>';
                    for (var key in components) {
                        html += '<option value="' + key + '">' + components[key] + '</option>';
                    }
                    html += '</select>';
                    list.options.components = html;
                }
            });

            $.each(this.el.find('.preview'), function (k, el) {
                list.setPreviewListener($(el))
            });

            $.each(this.el.find('.show-settings'), function (k, el) {
                $(el).click(function () {
                    $(this).siblings('.settings').removeClass('hidden')
                    $(this).addClass('hidden')
                });
            });

            $.each(this.el.find('.new-item'), function (k, el) {
                $(el).click(function () {
                    var parentNum = Number($(this).parent().parent().parent().attr('data-num'));
                    var parentId = Number($(this).parent().parent().parent().attr('data-id'));
                    var lastNum = Number($(this).parent().attr('data-count')) + 1;
                    $(this).parent().attr('data-count', lastNum);

                    var html = list.options.newItem;
                    html = html.replace(/{lastNum}/g, lastNum).replace(/{parentNum}/g, parentNum).replace(/{components}/g, list.options.components);
                    html = html.replace(/{type}/g, 'old').replace(/{parentId}/g, parentId).replace(/{sort}/g, lastNum);
                    $(this).before(html);

                    list.setPreviewListener($(this).siblings('.nested-item').last().find('.preview'))

                    $(this).siblings('.nested-item').last().find('.delete-new-item').click(function () {
                        $(this).closest('.nested-item').remove();
                    });
                });
            });

            $.each(this.el.find('.delete-item'), function (k, el) {
                $(el).click(function () {
                    $(el).closest('.nested-item').find('.item').first().addClass('hidden');
                    $(el).closest('.nested-item').find('.restore-item').first().removeClass('hidden');
                });
            });

            $.each(this.el.find('.restore-item'), function (k, el) {
                $(el).click(function () {
                    $(el).addClass('hidden');
                    $(el).siblings('.item').first().removeClass('hidden');
                });
            });

            this.el.find('.new-task').click(function () {
                var number = Number($(this).siblings('.nested-item').last().attr('data-num')) + 1;

                if (!number) {
                    number = 1;
                }

                var html = list.options.newTask;
                html = html.replace(/{number}/g, number).replace('{newItem}', list.options.newItem);
                html = html.replace(/{lastNum}/g, 1).replace(/{parentNum}/g, number).replace(/{components}/g, list.options.components);
                $(this).before(html);

                $(this).siblings('.nested-item').last().find('.preview').each(function (k, el) {
                    list.setPreviewListener($(el))
                });

                $(this).siblings('.nested-item').find('.new-item').click(function () {
                    var parentNum = Number($(this).parent().parent().attr('data-num'));
                    var lastNum = Number($(this).parent().attr('data-count')) + 1;
                    $(this).parent().attr('data-count', lastNum);

                    var html = list.options.newItem;
                    html = html.replace(/{lastNum}/g, lastNum).replace(/{parentNum}/g, parentNum).replace(/{components}/g, list.options.components);
                    $(this).before(html);

                    list.setPreviewListener($(this).siblings('.nested-item').last().find('.preview'));

                    $(this).siblings('.nested-item').last().find('.delete-new-item').click(function () {
                        $(this).closest('.nested-item').remove();
                    });
                });

                $(this).siblings('.nested-item').last().find('.delete-new-item').click(function () {
                    $(this).closest('.nested-item').remove();
                });
            });
        },

        setPreviewListener: function (el) {
            el.click(function () {
                var label = $(this).siblings('.new-label-input').val();
                var number = $(this).parent().siblings('.show-label').find('.number').text();
                $(this).parent().siblings('.show-label').empty().append('<b class="number">' + number + '</b>' + label);

                var content = $(this).siblings('.new-content-input').val();
                $(this).parent().siblings('.content').empty().append(content)
            });
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
