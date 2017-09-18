//FUNÇÃO I - get feature info
function actInfos(){

    var getFeat = new ol.interaction.Select();

    $('#getFeatInfo').click(function(){
        map.addInteraction(getFeat);

        getFeat.getFeatures().on('add', function(e) {
            var featSelect = e.element;
            if(featSelect.get('tabName') == "tb_places") featSelect.setStyle(styleSelects);
            else if(featSelect.get('tabName') == "tb_street") featSelect.setStyle(styleStreetSlc);
            
            viewInfo(featSelect, 'unique');
        });
    });

    $('#clearInfo').click(function(){
        map.removeInteraction(getFeat);

        $("#infos .respInfo").html("<p></p>").fadeOut(); 

        setColorDefault('street');
        setColorDefault('places');
        setColorDefault('myplaces');
        
        return false;
    });
    
}