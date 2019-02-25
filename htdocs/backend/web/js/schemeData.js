document.addEventListener('DOMContentLoaded', function () {
    var canvas, context

    var pointHtml = '<li class="list-group-item"><div class="form-group"><div class="row"><div class="col"><input type="text" id="point-text" class="form-control" placeholder="x" value="{{VALUE}}"></div><div class="col"><input type="text" id="point-x" class="form-control" placeholder="y" value="{{X}}"></div><div class="col"><input type="text" id="point-y" class="form-control" placeholder="y" value="{{Y}}"></div></div></div><button type="button" class="btn-sm btn-danger point-remove">Удалить</button> </li>'
    var html

    var pointsToDelete = []

    var element, name, value, x, y, vertical, direction // для элементов
    var text

    canvas = document.getElementById('scheme')
    if (canvas.getContext) {
        context = canvas.getContext('2d')
    }

    context.strokeStyle = 'black'
    context.font = 'bold 16px sans-serif'

    // рисуем изначальную схему
    drawScheme()

    // сохранение
    $('.save').click(function () {

    })

    // предосмотр
    $('.preview').click(function () {
        drawScheme()
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

    // удаление старых узлов
    $('.point-remove').each(function () {
        $(this).click(function () {
            var id = Number($(this).attr('data-id'))
            pointsToDelete.push(id)
            $(this).closest('li').remove()
            drawScheme()
        })
    })

    // добавление узла
    $('.point-add').click(function () {
        value = $('#point-text').val()
        x = Number($('#point-x').val())
        y = Number($('#point-y').val())
        // vertical = $('#vertical').is(':checked')

        html = pointHtml.replace(/{{NAME}}/g, name).replace(/{{VALUE}}/g, value).replace('{{VERTICAL}}', vertical).replace(/{{X}}/g, x).replace(/{{Y}}/g, y)
        $('.point-list').append(html)

        drawScheme()

        $('.point-remove').last().click(function () {
            $(this).closest('li').remove()
            drawScheme()
        })
    })

    // нарисовать все узлы по таблице
    function drawPoints() {
        $('.point-list').find('li').each(function () {
            x = $(this).find('#point-x').val()
            y = $(this).find('#point-y').val()
            text = $(this).find('#point-text').val()

            context.beginPath()
            context.clearRect(x - 3, y - 3, 6, 6)
            context.arc(x, y, 4, 0, 2 * Math.PI, true)
            context.stroke()
            context.closePath()
        })
    }

    // нарисовать элементы по таблице
    function drawElements() {
        $('.elements-list').find('li').each(function () {
            element = $(this).attr('data-type')
            name = $(this).attr('data-name')
            value = $(this).attr('data-value')
            x = Number($(this).attr('data-x'))
            y = Number($(this).attr('data-y'))
            vertical = $(this).attr('data-vertical') === 'true'
            direction = $(this).attr('data-direction') === 'true'
            drawElement()
        })
    }

    // нарисовать контура по таблице
    function drawCircuits() {
        context.beginPath()
        $('.circuits-list').find('.circuits-list-item').each(function () {
            $(this).find('.circuit-items').find('li').each(function (key) {
                x = Number($(this).find('#circuit-x').val())
                y = Number($(this).find('#circuit-y').val())
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

    // нарисовать текст по таблице
    function drawTexts() {
        $('.text-list').find('li').each(function () {
            text = $(this).attr('data-value')
            x = Number($(this).attr('data-x'))
            y = Number($(this).attr('data-y'))
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
