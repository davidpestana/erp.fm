


#albums
#truncate table fmi.ialbums;
insert into fmi.ialbums (id,slug,keywords,descripcion,titulo,descripcion_album,sevende,publicar) 
(select a.id, c.archivo as slug,c.criterios as keywords, c.descripcion, a.titulo, a.descripcion_album,a.sevende,a.publicar 
	from criterios c,albums a where seccion = 'albums' and c.id = a.id);




#limpio bad relations
delete FROM `albums_contenidos` WHERE id_album not in (select id from albums)


#fotos
#truncate table fmi.ifotos;
insert into fmi.ifotos 
	(id,slug,keywords,descripcion,titulo,descripcion_corta,descripcion_larga,icono,miniatura,foto,album_id) 
	(select f.id,c.archivo as slug,c.criterios as keywords, c.descripcion, f.titulo, 
		f.descripcion_corta,f.descripcion_larga,f.icono,f.miniatura,f.foto ,a.id as album_id
		from criterios c,fotos f, albums_contenidos ac, albums a 
		where seccion = 'fotos' and c.id = f.id and ac.id = f.id and ac.tipo ='foto' and a.id = ac.id_album);



#trabajos

insert into fmi.trabajos (slug,keywords,descripcion,titulo,descripcion_corta,familia,presentar,album_id) 
(select c.archivo as slug,c.criterios as keywords, c.descripcion, t.titulo, t.descripcion_corta,t.familia,t.presentar,t.album as album_id from criterios c,trabajos t where seccion = 'trabajos' and c.id = t.id)