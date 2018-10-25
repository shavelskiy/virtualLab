<canvas id="canvas" width="704" height="404"></canvas>

<div class="form-group">
    <label for="voltsDiv">Вольт на деление:</label>
    <select class="form-control" id="voltsDiv" name="test">
        <option value="1">1 V</option>
        <option value="2">2 V</option>
        <option value="5" selected>5 V</option>
        <option value="10">10 V</option>
    </select>
</div>

<label for="offsetX">Сдвиг по горизонтали</label>
<input type="range" id="offsetX" min="-500" max="500"/>

<label for="offsetY">Сдвиг по вертикали</label>
<input type="range" id="offsetY" min="-300" max="300"/>
