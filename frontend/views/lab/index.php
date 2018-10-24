<canvas id="canvas" width="1000" height="1000"></canvas>

<script language="javascript" type="text/javascript">
    var width = 700;
    var height = 400;
    var border = 2;
    var gridSpacingMain = 100;
    var gridSpacingSecond = 20;


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
        ctx.strokeStyle = 'rgb(255, 86, 76)';
        drawVerticalLines(ctx, gridSpacingSecond);
        drawHorizontalLines(ctx, gridSpacingSecond);
        
        // основная сетка
        ctx.strokeStyle = 'rgb(24, 86, 76)';
        drawVerticalLines(ctx, gridSpacingMain);
        drawHorizontalLines(ctx, gridSpacingMain);
    }

    function drawVerticalLines(ctx, gridSpacing) {
        var i = gridSpacing + border;
        while (i < width + border) {
            ctx.moveTo(i, border);
            ctx.lineTo(i, height + border);
            ctx.stroke();
            i = i + gridSpacing;
        }
    }

    function drawHorizontalLines(ctx, gridSpacing) {
        var i = gridSpacing + border;
        while (i < height + border) {
            ctx.moveTo(border, i);
            ctx.lineTo(width + border, i);
            ctx.stroke();
            i = i + gridSpacing;
        }
    }
</script>