<article class='boxToobar layersMap' id="layers">
    <header class="row">
        <h1 class="page-header"> <span class=" glyphicon glyphicon-check"></span> Select Layers</h1>    
    </header>
    <div class="content">
        <li><input type="checkbox" name="layers" value="places" checked><b> Places</b></li>
        <li><input type="checkbox" name="layers" value="street" checked> Street</li>
        <li><input type="checkbox" name="layers" value="sara" checked> Sara Brasil</li>
        <br>
        <li><input type="radio" name="layerbase" value="openstreetmap" checked> OpenStreetMap</li>
        <li><input type="radio" name="layerbase" value="bingRoad"> Esri</li>
        <li><input type="radio" name="layerbase" value="none"> Blank</li>
        
        <button type="button" class="btn btn-default" id="cl_layers" style="display:block; margin: 30px auto 0 auto;">
            <span class="glyphicon glyphicon-remove"></span> Close
        </button>
    </div>
</article>