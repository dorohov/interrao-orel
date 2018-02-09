'use strict';

$(function() {
	
	var yandex_map_div_id = 'yandex-map';
	var CMS__TPL_PATH = '/local/templates/azbn7theme';
	//var CMS__TPL_PATH = '';
	
	var yandex_map = $('#' + yandex_map_div_id);
	
	if(yandex_map.length) {
		
			var 
				map_area = yandex_map, 
				map_area_center = {		
					center: [52.971073, 36.052447], // расположение района
					zoom: 13,
					controls: ['smallMapDefaultSet']
				},
				map_area_block;
			
			var initYandexMapGlonass = function() {
				
				var map_area_block = new ymaps.Map(yandex_map_div_id, map_area_center, {
					//searchControlProvider: 'yandex#search'
				});
				
				//$('.azbn__contacts__item').each(function(index){
					
					//var block = $(this);
					//var block_data = JSON.parse(block.attr('data-contact') || '{}');
					
					//var polygonLayout_isActive = (index > 0) ? 'is--active' : '';
					var polygonLayout = ymaps.templateLayoutFactory.createClass('<div class="contacts-panel__location"><svg class="icon-svg icon-map-location" role="img"><use xlink:href="' + CMS__TPL_PATH + '/img/svg/sprite.svg#map-location"></use></svg></div>');		
					var clusterLayout = ymaps.templateLayoutFactory.createClass('<div style="color: #024f85; font-weight: bold;">$[properties.geoObjects.length]</div>');
					
					var items = $('.azbn__contacts__item');
					
					if(items.length) {
						
						var geoObjects = [];
						
						items.each(function(index){
							//if(index < 78) {
							var item = $(this);
							
							try {
								
								item.attr('data-item-index', index);
								
								var item_data = JSON.parse(item.attr('data-contact') || {});
								
								//item_data.title = encodeURIComponent(item_data.title);
								
								geoObjects.push(new ymaps.Placemark(item_data.coord, {
									//hintContent: '' 
								}, {
									iconLayout : polygonLayout,
									iconImageSize : [42, 52],
									iconImageOffset : [-21, -52],
									clusterCaption : item_data.title,
								}));
								/*
								map_area_block
									.geoObjects
										.add(map_placemark)
								;
								*/
								
								//console.dir([index, item_data]);
								
							} catch(ex) {
								
								console.dir(ex);
								//console.dir(item);
								
							}
							//}
						});
						
						
						
						
						var clusterer = new ymaps.Clusterer({
							preset : 'islands#nightClusterIcons',
							gridSize : 128,
							clusterIconContentLayout : clusterLayout ,
							groupByCoordinates : false,
							clusterDisableClickZoom : false,
							clusterHideIconOnBalloonOpen : false,
							geoObjectHideIconOnBalloonOpen : false,
						});
						
						/*
						clusterer.options.set({
							gridSize: 80,
							clusterDisableClickZoom: true
						});
						*/
						
						/*
						var collection = new ymaps.GeoObjectCollection(null, {
							
						});
						*/
						
						//collection.add(geoObjects);
						clusterer.add(geoObjects);
						map_area_block.geoObjects.add(clusterer);
						
						/**
						* Спозиционируем карту так, чтобы на ней были видны все объекты.
						*/
						
						
						map_area_block.setBounds(clusterer.getBounds(), {
							checkZoomRange: true,
						});
						
						
						$(document.body).on('click.azbn7', '.azbn__contacts__item a', null, function(event){
							event.preventDefault();
							
							var item = $(this).closest('.azbn__contacts__item');
							var item_data = JSON.parse(item.attr('data-contact') || {});
							
							map_area_block.setCenter(item_data.coord);
							map_area_block.setZoom(16, {
								smooth : true,
							});
							
						});
						
						
					}
					
					
					
				//});
			}
			
			if(map_area.length) {
				ymaps.ready(initYandexMapGlonass);
			}
		
	}
	
});