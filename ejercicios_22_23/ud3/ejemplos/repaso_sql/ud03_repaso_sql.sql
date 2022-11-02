-- o	Nombres de las imágenes de ítems de la categoría ‘X’

select imagen from imagenes inner join items on items. id=imagenes.id
						inner join categorias on categorias.id=items.id
                        where categoria like 'flores';
                        
-- o	Nombre e email de los usuarios que han pujado por ítems con un precio de partida entre 1000 y 5000

	select usuarios.nombre, usuarios.email from usuarios inner join pujas on usuarios.id=pujas.id_user
							  inner join items on items.id_user=pujas.id_user
                              where items.preciopartida between 1000 and 5000;
-- o	Fecha, nombre de usuario y nombre de ítem de la última puja

select usuarios.username, usuarios.nombre, items.nombre, pujas.fecha  from usuarios inner join pujas on usuarios.id=pujas.id_user
		inner join items on items.id_user=pujas.id_user
		order by pujas.fecha desc;

-- o	Cantidad de usuarios que tienen algún ítem, pero ninguna puja


-- o	Por cada fecha anterior al ‘2020/10/10’ en la que haya pujas, cuántas pujas hay y valor medio de éstas
-- o	Valor más alto pujado y a qué ítem (nombre) corresponde
-- o	Nombre de los ítems de categoría ‘X’, junto a cantidad media pujada por cada uno
-- o	Nombre y precio de partida de los ítems que no tienen ninguna imagen y tienen más de 3 pujas
-- o	Nombres de las categorías en las que hay al menos de 3 subastas vigentes
-- o	Nombre y descripción de los ítems cuya máxima puja al menos duplica el precio de partida
