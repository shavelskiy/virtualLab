<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="choose-scheme" class="col-sm-3 control-label px-3">Выбрать схему</label>
                        <div class="col-sm-5 px-0">
                            <select id="choose-scheme" class="form-control" @change="drawScheme"
                                    v-model.number="currentScheme">
                                <option v-for="n in schemeCol" :value="n - 1">{{ n }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <canvas id="scheme" width="640" height="360"></canvas>
            <div class="col">
                <div class="form-horizontal">
                    <div class="form-group" v-if="changeableR">
                        <label for="choose-resistor" class="col-sm-3 control-label px-3">Изменить R</label>
                        <div class="col-sm-5 px-0">
                            <select class="form-control" v-model="changeableData.r" v-on:change="sendData">
                                <option value="50">50 Ом</option>
                                <option value="100">100 Ом</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group" v-if="changeableC">
                        <label for="choose-resistor" class="col-sm-3 control-label px-3">Изменить C</label>
                        <div class="col-sm-5 px-0">
                            <select class="form-control" v-model="changeableData.c" v-on:change="sendData">
                                <option value="10">10 мкФ</option>
                                <option value="20">20 мкФ</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {bus} from '../bus.js'

    export default {
        name: "scheme",

        data() {
            return {
                schemesUrl: '/frontend/web/scheme/get',
                schemeInfo: null,
                schemeCol: null,
                changeableData: {
                    r: 50,
                    c: 10
                },
                currentScheme: 0,
                canvas: null,
                context: null
            }
        },

        mounted() {
            this.canvas = document.getElementById('scheme')
            if (this.canvas.getContext) {
                this.context = this.canvas.getContext('2d')
            }

            this.context.strokeStyle = 'black'
        },

        created() {
            this.$http.get(this.schemesUrl).then(function (response) {
                this.schemeInfo = JSON.parse(response.data)
                this.schemeCol = Object.keys(this.schemeInfo).length
                this.drawScheme()
            })
        },

        methods: {
            drawScheme: function () {
                var num = this.currentScheme
                var key, index

                this.context.clearRect(0, 0, this.canvas.width, this.canvas.height)


                for (key in this.schemeInfo[num].circuits) {
                    this.context.beginPath()
                    for (index in this.schemeInfo[num].circuits[key]) {
                        var element = this.schemeInfo[num].circuits[key][index]
                        if (index === 0) {
                            this.context.moveTo(element.x, element.y)
                        } else {
                            this.context.lineTo(element.x, element.y)
                        }
                    }
                    this.context.stroke()
                    this.context.closePath()
                }


                this.context.font = 'bold 16px sans-serif'
                for (key in this.schemeInfo[num].texts) {
                    var element = this.schemeInfo[num].texts[key]
                    this.context.fillText(element.text, element.x, element.y)
                }

                this.context.font = 'bold 10px sans-serif'
                for (key in this.schemeInfo[num].points) {
                    var element = this.schemeInfo[num].points[key]

                    this.context.beginPath()
                    this.context.clearRect(element.x - 3, element.y - 3, 6, 6)
                    this.context.arc(element.x, element.y, 4, 0, 2 * Math.PI, true)
                    this.context.stroke()
                    this.context.closePath()

                    var offsetX, offsetY

                    if (element.vertical) {
                        offsetX = -3
                        offsetY = (element.reverse) ? 14 : -7
                    } else {
                        offsetX = (element.reverse) ? -7 * (1 + element.text.length) : 7
                        offsetY = 4
                    }

                    this.context.fillText(element.text, element.x + offsetX, element.y + offsetY)
                }

                this.context.font = 'bold 16px sans-serif'
                for (key in this.schemeInfo[num].elements) {
                    var element = this.schemeInfo[num].elements[key]
                    this.drawElement(element.type, element.x, element.y, element.vertical, element.name)
                }

                bus.$emit('print-scheme-data', this.schemeInfo[num]['data'])
                bus.$emit('print-choose-points', this.schemeInfo[num]['points'])
                bus.$emit('load-values', this.schemeInfo[num]['values'])
            },

            // нарисовать элемент
            drawElement: function (type, x, y, vertical, name) {
                switch (type) {
                    case 'R':
                        this.drawResistor(x, y, vertical, name)
                        break
                    case 'C':
                        this.drawCapacitor(x, y, vertical, name)
                        break
                    case 'L':
                        this.drawCoil(x, y, vertical, name)
                        break
                    case 'G':
                        this.drawGng(x, y)
                        break
                }
            },

            // резистор
            drawResistor: function (x, y, vertical, name) {
                var width, height

                if (vertical) {
                    width = 20
                    height = 50
                    this.context.fillText(name, x + 15, y + 8)
                } else {
                    width = 50
                    height = 20
                    this.context.fillText(name, x - 8, y - 15)
                }

                this.context.clearRect(x - width / 2, y - height / 2, width, height)
                this.context.strokeRect(x - width / 2, y - height / 2, width, height)
            },

            // конденсатор
            drawCapacitor: function (x, y, vertical, name) {
                var width, height

                if (vertical) {
                    width = 50
                    height = 10
                    this.context.fillText(name, x + 28, y + 6)
                } else {
                    width = 10
                    height = 50
                    this.context.fillText(name, x - 9, y - 30)
                }

                this.context.clearRect(x - width / 2, y - height / 2, width, height)
                this.context.beginPath()
                if (vertical) {
                    this.context.moveTo(x - width / 2, y - height / 2)
                    this.context.lineTo(x + width / 2, y - height / 2)
                    this.context.moveTo(x - width / 2, y + height / 2)
                    this.context.lineTo(x + width / 2, y + height / 2)
                } else {
                    this.context.moveTo(x - width / 2, y + height / 2)
                    this.context.lineTo(x - width / 2, y - height / 2)
                    this.context.moveTo(x + width / 2, y - height / 2)
                    this.context.lineTo(x + width / 2, y + height / 2)
                }
                this.context.stroke()
                this.context.closePath()
            },

            // катушка
            drawCoil: function (x, y, vertical, name) {
                var width, height

                if (vertical) {
                    width = 20
                    height = 60
                    this.context.fillText(name, x + 9, y + 7)
                } else {
                    width = 60
                    height = 20
                    this.context.fillText(name, x - 9, y - 20)
                }

                this.context.clearRect(x - width / 2, y - height / 2, width, height)
                this.context.beginPath()
                if (vertical) {
                    this.context.arc(x, y + width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true)
                } else {
                    this.context.arc(x - height, y, height / 2, 0, Math.PI, true)
                }
                this.context.stroke()
                this.context.closePath()
                this.context.beginPath()
                if (vertical) {
                    this.context.arc(x, y, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true)
                } else {
                    this.context.arc(x, y, height / 2, 0, Math.PI, true)
                }
                this.context.stroke()
                this.context.closePath()
                this.context.beginPath()
                if (vertical) {
                    this.context.arc(x, y - width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true)
                } else {
                    this.context.arc(x + height, y, height / 2, 0, Math.PI, true)
                }
                this.context.stroke()
                this.context.closePath()
            },

            // источник эдс
            drawVoltageSource: function (x, y, vertical, direction, name) {

                this.context.beginPath()
                this.context.arc(x, y, 20, 0, 2 * Math.PI, true)
                this.context.stroke()
                this.context.closePath()
                this.context.beginPath()

                if (vertical) {
                    if (direction) {
                        this.context.moveTo(x, y - 20)
                        this.context.lineTo(x + 5, y - 5)
                        this.context.lineTo(x - 5, y - 5)
                    } else {
                        this.context.moveTo(x, y + 20)
                        this.context.lineTo(x + 5, y + 5)
                        this.context.lineTo(x - 5, y + 5)
                    }
                    this.context.fillText(name, x + 25, y + 6)
                } else {
                    if (direction) {
                        this.context.moveTo(x + 20, y)
                        this.context.lineTo(x + 5, y - 5)
                        this.context.lineTo(x + 5, y + 5)
                    } else {
                        this.context.moveTo(x - 20, y)
                        this.context.lineTo(x - 5, y - 5)
                        this.context.lineTo(x - 5, y + 5)
                    }
                    this.context.fillText(name, x - 10, y - 25)
                }

                this.context.fill()
                this.context.closePath()
            },

            // земля
            drawGng: function (x, y) {
                var width = 20, height = 10

                this.context.clearRect(x - width / 2, y, width, height)
                this.context.beginPath()

                this.context.moveTo(x, y)
                this.context.lineTo(x, y + height)
                this.context.moveTo(x - width / 2, y + height)
                this.context.lineTo(x + width / 2, y + height)

                this.context.stroke()
                this.context.closePath()
            },

            sendData: function () {
                bus.$emit('send-changeable-data', this.changeableData)
            }
        },

        computed: {
            changeableR: function () {
                if (this.schemeInfo) {
                    if (this.schemeInfo[this.currentScheme]['changeable_r']) {
                        return true
                    } else {
                        return false
                    }
                } else {
                    return false
                }
            },
            changeableC: function () {
                if (this.schemeInfo) {
                    if (this.schemeInfo[this.currentScheme]['changeable_c']) {
                        return true
                    } else {
                        return false
                    }
                } else {
                    return false
                }
            }
        }
    }
</script>

<style scoped>
    .panel {
        height: 100%;
    }
</style>
