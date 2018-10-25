<canvas id="canvas" width="1000" height="1000"></canvas>

<script language="javascript" type="text/javascript">
    var width = 700;
    var height = 400;
    var border = 2;
    var gridSpacingMain = 100;
    var gridSpacingSecond = 20;

    var amplimude = 5;
    var freq = 10;
    var phase = 0;

    var voltDiv = 5; // сколько вольт в одной клетке
    var secondsDiv = 1; // сколько секунд в одной клетке
    var offsetX = 0;
    var offsetY = 0;

    var step = 2;

    var canvas = document.getElementById('canvas');
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');

        // основной прямоугольник
        ctx.fillStyle = 'rgb(93, 177, 162)';
        ctx.fillRect(border, border, width, height);

        // внешняя рамка
        ctx.strokeStyle = 'rgb(223, 223, 223)';
        ctx.strokeRect(1, 1, width + border, height + border);

        // вспомогательная сетка
        ctx.strokeStyle = 'rgb(128, 128, 128)';
        ctx.beginPath();
        drawVerticalLines(ctx, gridSpacingSecond);
        drawHorizontalLines(ctx, gridSpacingSecond);
        ctx.stroke();
        ctx.closePath();

        // основная сетка
        ctx.strokeStyle = 'rgb(24, 86, 76)';
        ctx.beginPath();
        drawVerticalLines(ctx, gridSpacingMain);
        drawHorizontalLines(ctx, gridSpacingMain);
        ctx.stroke();
        ctx.closePath();

        ctx.strokeStyle = "olive";
        ctx.beginPath();
        drawSin();
        ctx.lineWidth = 2;
        ctx.stroke();
        ctx.closePath();
    }

    function drawVerticalLines(ctx, gridSpacing) {
        var i = gridSpacing + border;
        while (i < width + border) {
            ctx.moveTo(i, border);
            ctx.lineTo(i, height + border);
            i = i + gridSpacing;
        }
    }

    function drawHorizontalLines(ctx, gridSpacing) {
        var i = gridSpacing + border;
        while (i < height + border) {
            ctx.moveTo(border, i);
            ctx.lineTo(width + border, i);
            i = i + gridSpacing;
        }
    }

    function drawSin() {
        var xStart = border + offsetX;
        var yStart = height / 2 - offsetY;
        ctx.moveTo(xStart, yStart + getY(0));
        for (var t = 1; t < width / step; t++) {
            ctx.lineTo(xStart + step * t, yStart + getY(t));
        }
    }

    function getY(t) {
        return amplimude * voltDiv * Math.sin(10 * t / 180 * Math.PI + phase);
    }
</script>