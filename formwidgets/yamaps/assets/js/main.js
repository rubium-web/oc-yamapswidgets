var marker = new Array;

function parsePos(obj) {
    var position = [0,0];                
    try{
        position = JSON.parse(obj).position;
    }catch(e){console.error('Cant prse value ',obj)}
    
    if(typeof(position) == "object" && position.length == 2)
        return position;

    return [0,0];
}

function inicializar(x, y, zoom, index, mapDiv, custom)
{   
    ymaps.ready(init);

    function init() { 
        // Создание карты.    
        var yMap = new ymaps.Map(mapDiv + '-div', {
            center: [x, y],
            zoom: zoom
        });

        if(custom && custom.markers && custom.markers.length){
            // if we have many markers
            for(var mark of custom.markers) {
                var position = parsePos(mark.latlng);
                
                var markPos = {
                    x: position[0],
                    y: position[1]
                };
                var placemark = addMarker(yMap, markPos);
                yMap.geoObjects.add(placemark);
            }

            // if we have many marks, fit to view
            if(Object.keys(custom.markers).length > 1) yMap.setBounds(yMap.geoObjects.getBounds());

        }else{
            // for single marker
            var placemark = addMarker(yMap, { x: x, y: y });
            yMap.geoObjects.add(placemark);
        }       

        if(custom.editable !== false || !custom){
            // if user can pick new marker
            placemark.geometry.events.add("change", function () {
                let bounds = placemark.geometry.getBounds();
                if(Object.keys(bounds).length == 2)
                    placeMarker(mapDiv, bounds[0]);
            });

            yMap.events.add('click', function (e) {
                var position = e.get('coords');
                placemark.geometry.setCoordinates(position);
            });
        }

        $("#"+mapDiv).on('change-cords', function(event, data) {
            var mark = data.split(",");
             placemark.geometry.setCoordinates(mark);
             yMap.setCenter(mark);
        });
    }
  
}

function placeMarker(mapDiv, setMapPosition)
{
    var value = { position: setMapPosition };
    $('#' + mapDiv).val(JSON.stringify(value));
}

function addMarker(map, position) {
    return new ymaps.Placemark([position.x, position.y], {}, {
        preset: "islands#icon",
        iconColor: '#ff0000',
        // draggable: true
    });
}