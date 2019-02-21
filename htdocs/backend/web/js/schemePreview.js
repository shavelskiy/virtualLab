document.addEventListener('DOMContentLoaded', function () {
    var canvas, context

    var type, name, x, y, vertical, direction // для элементов
    var data

    canvas = document.getElementById('scheme')
    if (canvas.getContext) {
        context = canvas.getContext('2d')
    }

    // удалить схему
    $('.delete-scheme').each(function () {
        $(this).click(function () {
            if (confirm('Удалить схему без возможности восстановления?')) {
                console.log(Number($(this).attr('data-id')))
                $.ajax({
                    method: 'POST',
                    url: '/backend/web/scheme/delete',
                    data: {'schemeId': Number($(this).attr('data-id'))},
                    success: function () {
                        location.reload()
                    }
                })
            }
        })
    })

    // нарисовать схему
    $('.draw-scheme').each(function () {
        $(this).click(function () {
            $.ajax({
                method: 'GET',
                data: {'schemeId': Number($(this).attr('data-id'))},
                url: '/frontend/web/scheme/info',
                success: function (info) {
                    context.clearRect(0, 0, canvas.width, canvas.height)
                    data = JSON.parse(info)

                    var key
                    for (key in data.circuits) {
                        context.beginPath()
                        data.circuits[key].forEach(function (item, index) {
                            if (index === 0) {
                                context.moveTo(item.x, item.y)
                            } else {
                                context.lineTo(item.x, item.y)
                            }
                        })
                        context.stroke()
                        context.closePath()
                    }

                    data.elements.forEach(function (item) {
                        type = item.type
                        name = item.name
                        x = item.x
                        y = item.y
                        vertical = item.vertical === 1
                        direction = item.direction === 1
                        drawElement()
                    })

                    data.texts.forEach(function (item) {
                        context.fillText(item.text, item.x, item.y)
                    })
                }
            })
        })
    })

    // нарисовать элемент
    function drawElement() {
        switch (type) {
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
})
