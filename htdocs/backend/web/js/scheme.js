document.addEventListener('DOMContentLoaded', function () {
    var canvas, context
    var currentSettings = $('.circuits-setting'),
        currentPanel = $('.circuits-panel'),
        currentTab = $('.nav-tabs').find('.active')

    var circuitHtml = '<li class="list-group-item circuits-list-item"><ul class="list-group circuit-items ">{{INPUT}}</ul><button type="button" class="btn-sm btn-primary circuit-point-add">Добавить точку</button><button type="button" class="btn-sm btn-danger circuit-remove">Удалить</button></li>',
        coordinateHtml = '<li class="list-group-item"><div class="form-group row"><label for="circuit-x-{{SORT}}" class="col-sm-1 offset-1 col-form-label mx-2 text-center">X:</label><input type="text" id="circuit-x-{{SORT}}" class="form-control col-sm-4 pl-2 circuit-x" placeholder="x"><label for="circuit-y-{{SORT}}" class="col-sm-1 col-form-label mx-2 text-center">Y:</label><input type="text" id="circuit-y-{{SORT}}" class="form-control col-sm-4 pl-2 circuit-y" placeholder="y"></div></li>',
        elementHtml = '<li class="list-group-item" data-type="{{TYPE}}"><div class="row"><div class="form-group row"><label for="item-name-{{SORT}}" class="col-sm-3 col-form-label ml-2 text-center">Название:</label><input type="text" id="item-name-{{SORT}}" class="form-control col-sm-2 item-name" placeholder="Название" value="{{NAME}}"><label for="item-value-{{SORT}}" class="col-sm-3 col-form-label text-center">Значение:</label><input type="text" id="item-value-{{SORT}}" class="form-control col-sm-3 item-value" placeholder="Значение" value="{{VALUE}}"></div> <div class="form-check-inline row"><label for="item-x-{{SORT}}" class="col-sm-1 ml-4 px-0 col-form-label text-center">X:</label><input type="text" id="item-x-{{SORT}}" class="form-control col-sm-2 item-x" placeholder="x" value="{{X}}"><label for="item-y-{{SORT}}" class="col-sm-1 col-form-label text-center">Y:</label><input type="text" id="item-y-{{SORT}}" class="form-control col-sm-2 item-y" placeholder="y" value="{{Y}}"><label for="item-vertical-{{SORT}}" class="col-sm form-check-label pr-2">Веритикально:</label><input type="checkbox" id="item-vertical-{{SORT}}" class="form-check-input col-sm item-vertical" {{VERTICAL}}></div></div><button type="button" class="btn-sm btn-danger ml-5 mt-3 element-remove">Удалить</button></li>',
        pointHtml = '<li class="list-group-item"><div class="form-group row"><label for="point-text-{{SORT}}" class="col-sm-2 px-0 ml-4 col-form-label text-center">Номер:</label><input type="text" id="point-text-{{SORT}}" class="form-control col-sm-2 point-text" placeholder="Номер" value="{{VALUE}}"><label for="point-x-{{SORT}}" class="col-sm-1 px-0 ml-3 col-form-label text-center">X:</label><input type="text" id="point-x-{{SORT}}" class="form-control col-sm-2 point-x" placeholder="x" value="{{X}}"> <label for="point-y-{{SORT}}" class="col-sm-1 px-0 ml-3 col-form-label text-center">Y:</label><input type="text" id="point-y-{{SORT}}" class="form-control col-sm-2 point-y" placeholder="y" value="{{Y}}"></div><div class="form-check-inline row mb-4"><label for="point-vertical-{{SORT}}" class="col-sm form-check-label pr-2">Веритикально:</label><input type="checkbox" id="point-vertical-{{SORT}}" class="form-check-input col-sm point-vertical" {{VERTICAL}}><label for="point-reverse-{{SORT}}" class="col-sm form-check-label pr-2">Инверсия:</label><input type="checkbox" id="point-reverse-{{SORT}}" class="form-check-input col-sm point-reverse" {{REVERSE}}></div><button type="button" class="btn-sm btn-danger point-remove">Удалить</button></li>',
        textHtml = '<li class="list-group-item"><div class="form-group row"><label for="text-value-{{SORT}}" class="col-sm-2 px-0 ml-4 col-form-label text-center">Текст:</label><input type="text" id="text-value-{{SORT}}" class="form-control col-sm-2 text-value" placeholder="Текст" value="{{TEXT}}"><label for="text-x-{{SORT}}" class="col-sm-1 px-0 ml-3 col-form-label text-center">X:</label><input type="text" id="text-x-{{SORT}}" class="form-control col-sm-2 text-x" placeholder="x" value="{{X}}"><label for="text-y-{{SORT}}" class="col-sm-1 px-0 ml-3 col-form-label text-center">Y:</label><input type="text" id="text-y-{{SORT}}" class="form-control col-sm-2 text-y" placeholder="y" value="{{Y}}"></div><button type="button" class="btn-sm btn-danger text-remove">Удалить</button></li>'

    var html
    var element, name, value, x, y, vertical, reverse // для элементов
    var text
    var circuitsToDelete = [], elementsToDelete = [], textsToDelete = [], pointsToDelete = []

    canvas = document.getElementById('scheme')
    if (canvas.getContext) {
        context = canvas.getContext('2d')
    }

    context.strokeStyle = 'black'

    // рисуем изначальную схему
    drawScheme()

    // управление вкладками
    $('.change-tab').each(function () {
        $(this).click(function () {
            currentTab.removeClass('active')
            currentTab = $(this)
            currentTab.addClass('active')

            currentSettings.addClass('hidden')
            currentPanel.addClass('hidden')
            switch ($(this).attr('data-tab')) {
                case 'circuit':
                    currentSettings = $('.circuits-setting')
                    currentPanel = $('.circuits-panel')
                    break
                case 'element':
                    currentSettings = $('.elements-setting')
                    currentPanel = $('.elements-panel')
                    break
                case 'points':
                    currentSettings = $('.points-setting')
                    currentPanel = $('.points-panel')
                    break
                case 'text':
                    currentSettings = $('.texts-setting')
                    currentPanel = $('.texts-panel')
                    break
            }
            currentSettings.removeClass('hidden')
            currentPanel.removeClass('hidden')
        })
    })

    // сохранение схемы
    $('.save').click(function () {
        var circuits = []
        $('.circuits-list').find('.circuits-list-item').each(function () {
            var curCircuit = {}
            var points = []
            var sort = 0

            $(this).find('.circuit-items').find('li').each(function () {
                if ($(this).attr('data-id')) {
                    sort++
                } else {
                    var point = {}
                    point.x = Number($(this).find('.circuit-x').val())
                    point.y = Number($(this).find('.circuit-y').val())
                    points.push(point)
                }
            })

            curCircuit.parentId = $(this).find('.circuit-remove').attr('data-parent-id')
            curCircuit.lastSort = sort
            curCircuit.points = points

            circuits.push(curCircuit)
        })

        var elements = []
        $('.elements-list').find('li').each(function () {
            var curElement = {}
            curElement.id = $(this).find('.element-remove').attr('data-id')
            curElement.element = $(this).attr('data-type')
            curElement.name = $(this).find('.item-name').val()
            curElement.value = $(this).find('.item-value').val()
            curElement.x = Number($(this).find('.item-x').val())
            curElement.y = Number($(this).find('.item-y').val())
            curElement.vertical = $(this).find('.item-vertical').is(':checked')
            elements.push(curElement)
        })

        var points = []
        $('.point-list').find('li').each(function () {
            var curPoint = {}
            curPoint.id = $(this).find('.point-remove').attr('data-id')
            curPoint.x = Number($(this).find('.point-x').val())
            curPoint.y = Number($(this).find('.point-y').val())
            curPoint.text = $(this).find('.point-text').val()
            curPoint.vertical = $(this).find('.point-vertical').is(':checked')
            curPoint.reverse = $(this).find('.point-reverse').is(':checked')
            points.push(curPoint)
        })

        var texts = []
        $('.text-list').find('li').each(function () {
            var curText = {}
            curText.id = $(this).find('.text-remove').attr('data-id')
            curText.text = $(this).find('.text-value').val()
            curText.x = Number($(this).find('.text-x').val())
            curText.y = Number($(this).find('.text-y').val())
            texts.push(curText)
        })

        $.ajax({
            method: 'POST',
            url: location.href,
            data: JSON.stringify({
                'circuits': {
                    'save': circuits,
                    'delete': circuitsToDelete
                },
                'elements': {
                    'save': elements,
                    'delete': elementsToDelete
                },
                'points': {
                    'save': points,
                    'delete': pointsToDelete
                },
                'texts': {
                    'save': texts,
                    'delete': textsToDelete
                },
                'changeable_r': $('#changeable_r').is(':checked'),
                'changeable_c': $('#changeable_c').is(':checked')
            }),
            success: function () {
                console.log('done')
            }
        })
    })

    // предосмотр
    $('body').keyup(function () {
        drawScheme()
    })

    $('body').click(function () {
        drawScheme()
    })

    // удаление старых контуров
    $('.circuit-remove').each(function () {
        $(this).click(function () {
            var id = Number($(this).attr('data-parent-id'))
            circuitsToDelete.push(id)
            $(this).closest('li').remove()
        })
    })

    // удаление старых элементов
    $('.element-remove').each(function () {
        $(this).click(function () {
            var id = Number($(this).attr('data-id'))
            elementsToDelete.push(id)
            $(this).closest('li').remove()
        })
    })

    // удаление старых узлов
    $('.point-remove').each(function () {
        $(this).click(function () {
            var id = Number($(this).attr('data-id'))
            pointsToDelete.push(id)
            $(this).closest('li').remove()
        })
    })

    // удаление старых текстов
    $('.text-remove').each(function () {
        $(this).click(function () {
            var id = Number($(this).attr('data-id'))
            textsToDelete.push(id)
            $(this).closest('li').remove()
        })
    })

    // добавление точек у существующих контуров
    $('.circuit-point-add').each(function () {
        $(this).click(function () {
            $(this).siblings('.circuit-items').append(coordinateHtml)
        })
    })

    // добавление нового контура
    $('.circuit-add').click(function () {
        html = circuitHtml
            .replace('{{INPUT}}', coordinateHtml)
            .replace(/{{SORT}}/g, $('.circuits-list').find('.circuits-list-item').length + '-0')

        $('.circuits-list').append(html)

        $('.circuits-list').find('.circuits-list-item').last().find('.circuit-point-add').click(function () {
            $(this).siblings('.circuit-items').append(coordinateHtml.replace(/{{SORT}}/g, $('.circuits-list').find('.circuits-list-item').length + '-' + $(this).siblings('ul').find('li').length))
        })

        $('.circuits-list').find('.circuits-list-item').last().find('.circuit-remove').click(function () {
            $(this).closest('.circuits-list-item').remove()
        })
    })

    // добавление узла
    $('.point-add').click(function () {
        value = $('#point-text').val()
        x = Number($('#point-x').val())
        y = Number($('#point-y').val())
        vertical = $('#point-vertical').is(':checked')
        reverse = $('#point-reverse').is(':checked')

        html = pointHtml
            .replace(/{{NAME}}/g, name)
            .replace(/{{VALUE}}/g, value)
            .replace(/{{X}}/g, x).replace(/{{Y}}/g, y)
            .replace(/{{SORT}}/g, $('.point-list').find('li').length)
            .replace(/{{VERTICAL}}/, vertical ? 'checked' : '')
            .replace(/{{REVERSE}}/, reverse ? 'checked' : '')

        $('.point-list').append(html)

        $('.point-remove').last().click(function () {
            $(this).closest('li').remove()
        })
    })

    // добавление элемента
    $('.element-add').click(function () {
        element = $('#element-select').val()
        name = $('#element-name').val()
        value = $('#element-value').val()
        x = Number($('#x-coordinate').val())
        y = Number($('#y-coordinate').val())
        vertical = $('#vertical').is(':checked')

        html = elementHtml
            .replace(/{{NAME}}/g, name)
            .replace('{{TYPE}}', element)
            .replace(/{{VALUE}}/g, value)
            .replace('{{VERTICAL}}', vertical ? 'checked' : '')
            .replace(/{{X}}/g, x).replace(/{{Y}}/g, y)
            .replace(/{{SORT}}/g, $('.elements-list').find('li').length)

        $('.elements-list').append(html)

        $('.element-remove').last().click(function () {
            $(this).closest('li').remove()
        })
    })

    // добавление текста
    $('.text-add').click(function () {
        text = $('#text-value').val()
        x = Number($('#text-x').val())
        y = Number($('#text-y').val())

        html = textHtml
            .replace(/{{X}}/g, x)
            .replace(/{{Y}}/g, y)
            .replace(/{{TEXT}}/g, text)
            .replace(/{{SORT}}/g, $('.text-list').find('li').length)

        $('.text-list').append(html)

        $('.text-remove').last().click(function () {
            $(this).closest('li').remove()
        })
    })

    // нарисовать всю схему
    function drawScheme() {
        context.clearRect(0, 0, canvas.width, canvas.height)
        drawGrid()
        drawCircuits()
        drawElements()
        drawTexts()
        drawPoints()
    }

    // нарисовать элементы по таблице
    function drawElements() {
        context.font = 'bold 16px sans-serif'
        $('.elements-list').find('li').each(function () {
            element = $(this).attr('data-type')
            name = $(this).find('.item-name').val()
            value = $(this).find('.item-value').val()
            x = Number($(this).find('.item-x').val())
            y = Number($(this).find('.item-y').val())
            vertical = $(this).find('.item-vertical').is(':checked')
            drawElement()
        })
    }

    // нарисовать контура по таблице
    function drawCircuits() {
        context.beginPath()
        $('.circuits-list').find('.circuits-list-item').each(function () {
            $(this).find('.circuit-items').find('li').each(function (key) {
                x = Number($(this).find('.circuit-x').val())
                y = Number($(this).find('.circuit-y').val())
                if (key === 0) {
                    context.moveTo(x, y)
                } else {
                    context.lineTo(x, y)
                }
            })
        })
        context.stroke()
        context.closePath()
    }

    // нарисовать все узлы по таблице
    function drawPoints() {
        context.font = 'bold 10px sans-serif'
        $('.point-list').find('li').each(function () {
            x = Number($(this).find('.point-x').val())
            y = Number($(this).find('.point-y').val())
            text = $(this).find('.point-text').val()
            vertical = $(this).find('.point-vertical').is(':checked')
            reverse = $(this).find('.point-reverse').is(':checked')

            context.beginPath()
            context.clearRect(x - 3, y - 3, 6, 6)
            context.arc(x, y, 4, 0, 2 * Math.PI, true)
            context.stroke()
            context.closePath()

            var offsetX, offsetY

            if (vertical) {
                offsetX = -3
                offsetY = (reverse) ? 14 : -7
            } else {
                offsetX = (reverse) ? -7 * (1 + text.length) : 7
                offsetY = 4
            }

            context.fillText(text, x + offsetX, y + offsetY)
        })
    }

    // нарисовать текст по таблице
    function drawTexts() {
        context.font = 'bold 16px sans-serif'
        $('.text-list').find('li').each(function () {
            text = $(this).find('.text-value').val()
            x = Number($(this).find('.text-x').val())
            y = Number($(this).find('.text-y').val())
            context.fillText(text, x, y)
        })
    }

    // нарисовать элемент
    function drawElement() {
        switch (element) {
            case 'R':
                drawResistor()
                break
            case 'C':
                drawCapacitor()
                break
            case 'L':
                drawCoil()
                break
        }
    }

    // резистор
    function drawResistor() {
        var width, height

        if (vertical) {
            width = 20
            height = 50
            context.fillText(name, x + 15, y + 8)
        } else {
            width = 50
            height = 20
            context.fillText(name, x - 8, y - 15)
        }

        context.clearRect(x - width / 2, y - height / 2, width, height)
        context.strokeRect(x - width / 2, y - height / 2, width, height)
    }

    // конденсатор
    function drawCapacitor() {
        var width, height

        if (vertical) {
            width = 50
            height = 10
            context.fillText(name, x + 28, y + 6)
        } else {
            width = 10
            height = 50
            context.fillText(name, x - 9, y - 30)
        }

        context.clearRect(x - width / 2, y - height / 2, width, height)
        context.beginPath()

        if (vertical) {
            context.moveTo(x - width / 2, y - height / 2)
            context.lineTo(x + width / 2, y - height / 2)
            context.moveTo(x - width / 2, y + height / 2)
            context.lineTo(x + width / 2, y + height / 2)
        } else {
            context.moveTo(x - width / 2, y + height / 2)
            context.lineTo(x - width / 2, y - height / 2)
            context.moveTo(x + width / 2, y - height / 2)
            context.lineTo(x + width / 2, y + height / 2)
        }
        context.stroke()
        context.closePath()
    }

    // катушка
    function drawCoil() {
        var width, height

        if (vertical) {
            width = 20
            height = 60
            context.fillText(name, x + 9, y + 7)
        } else {
            width = 60
            height = 20
            context.fillText(name, x - 9, y - 20)
        }

        context.clearRect(x - width / 2, y - height / 2, width, height)
        context.beginPath()
        if (vertical) {
            context.arc(x, y + width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true)
        } else {
            context.arc(x - height, y, height / 2, 0, Math.PI, true)
        }
        context.stroke()
        context.closePath()
        context.beginPath()
        if (vertical) {
            context.arc(x, y, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true)
        } else {
            context.arc(x, y, height / 2, 0, Math.PI, true)
        }
        context.stroke()
        context.closePath()
        context.beginPath()
        if (vertical) {
            context.arc(x, y - width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true)
        } else {
            context.arc(x + height, y, height / 2, 0, Math.PI, true)
        }
        context.stroke()
        context.closePath()
    }

    // нарисовать сетку
    function drawGrid() {
        context.lineWidth = 0.1
        context.beginPath()
        for (var i = 50; i <= canvas.width; i += 50) {
            context.moveTo(i, 0)
            context.lineTo(i, canvas.height)
        }

        for (var i = 50; i <= canvas.height; i += 50) {
            context.moveTo(0, i)
            context.lineTo(canvas.width, i)
        }
        context.stroke()
        context.closePath()
        context.lineWidth = 1
    }
})
