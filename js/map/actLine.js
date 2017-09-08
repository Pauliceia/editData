//VARIAVEIS (OBJETOS) -> line - PARA A INTERAÇÃO COM O MAPA
var selectLine = new ol.interaction.Select();

//AO CLICAR NO BOTÃO PARA DUPLICAR FEATURE
function actLine(){
    $('#selectStLine').click(function(){
        clearInteraction('point');
        $(this).addClass('activeOptions');
        getStreetLine('insertData');
        return false;
    });
    
    $('#alterStLine').click(function(){
        clearInteraction('point');
        getStreetLine('editData');
        return false;
    });

    function getStreetLine(type){
        map.addInteraction(selectLine);  

        selectLine.getFeatures().on('add', function(e) {
            var featSelect = e.element;
            if(featSelect.get("tabName") == 'tb_street'){
                var idStreet = featSelect.get("id");
                var nameStreet = featSelect.get("name");

                $('#'+type+' input[name="id_street"]').val(idStreet);
                $('#'+type+' input[name="street"]').val(nameStreet);

                featSelect.setStyle(styleStreetSlc);
            }
        });
    }
}
