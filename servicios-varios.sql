CREATE DATABASE servicios_varios;

USE servicios_varios;

CREATE TABLE categorias (
  id_categoria int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_categoria varchar(255) NOT NULL,
  descripcion text NOT NULL
);

CREATE TABLE tipos (
  id_tipo int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_tipo varchar(255) NOT NULL
);

CREATE TABLE ubicaciones (
  id_ubicacion int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pais varchar(255) NOT NULL,
  region varchar(255) NOT NULL,
  ciudad varchar(255) NOT NULL
);

CREATE TABLE servicios (
  id_servicio int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_servicio varchar(255) NOT NULL,
  descripcion text NOT NULL,
  id_categoria int(255) NOT NULL,
  FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

CREATE TABLE usuarios (
  id_usuario int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(255) NOT NULL,
  apellido varchar(255) NOT NULL,
  correo varchar(255) NOT NULL,
  telefono varchar(20) DEFAULT NULL,
  direccion varchar(255) DEFAULT NULL,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  id_tipo int(255) NOT NULL,
  id_ubicacion int(255) NOT NULL,
  FOREIGN KEY (id_tipo) REFERENCES tipos(id_tipo),
  FOREIGN KEY (id_ubicacion) REFERENCES ubicaciones(id_ubicacion)
);

CREATE TABLE solicitud_servicios (
  id_solicitud int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fecha_apertura datetime NOT NULL,
  fecha_cierre datetime DEFAULT NULL,
  precio_ofertado double NOT NULL,
  descripcion text DEFAULT NULL,
  id_ubicacion int(255) NOT NULL,
  id_servicio int(255) NOT NULL,
  id_usuario int(255) NOT NULL,
  FOREIGN KEY (id_ubicacion) REFERENCES ubicaciones(id_ubicacion),
  FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE contratos (
  id_contrato int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_solicitud int(255) NOT NULL,
  id_usuario int(255) NOT NULL,
  FOREIGN KEY (id_solicitud) REFERENCES solicitud_servicios(id_solicitud),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

/*
  --insert data--
  -categorias
  -tipos
  -ubicaciones
  -servicios
  -usuarios
  -solicitud_servicios
  -contratos
*/

INSERT INTO categorias (nombre_categoria, descripcion) VALUES
('Limpieza', 'Limpieza doméstica, comercial e industrial'),
('Transporte', 'Mensajería, mercancías'),
('Consultoria', 'asesoría legal, consultoría de negocios, recursos humanos');

INSERT INTO tipos (nombre_tipo) VALUES
('Usuario'),
('Trabajador'),
('Administrador');

INSERT INTO ubicaciones (pais, region, ciudad) VALUES
('Colombia', 'Cundinamarca', 'Bogota'),
('Colombia', 'Santander', 'Barrancabermeja');

INSERT INTO servicios (nombre_servicio, descripcion, id_categoria) VALUES
('Limpieza de casas', 'Limpieza exhaustiva de todo tipo de residencias, incluyendo la desinfección de baños, cocinas, salas y habitaciones. Se utilizan productos ecológicos y personal capacitado para garantizar un ambiente saludable.', 1),
('Limpieza de oficinas', 'Servicio de limpieza para oficinas corporativas que incluye la limpieza de escritorios, alfombras, áreas comunes y equipos electrónicos como computadoras, impresoras, y teléfonos, manteniendo un entorno de trabajo limpio y ordenado.', 1),
('Limpieza de fábricas', 'Limpieza especializada para fábricas y plantas industriales, con técnicas avanzadas para eliminar residuos industriales, polvo y desechos, asegurando el cumplimiento de las normativas de seguridad e higiene.', 1),
('Lavado de ventanas', 'Servicio profesional de limpieza de ventanas en altura y a nivel del suelo, tanto para edificios comerciales como residenciales. Utilizamos técnicas de limpieza con agua purificada para evitar rayones y asegurar una visibilidad perfecta.', 1),
('Limpieza profunda', 'Limpieza detallada de todos los rincones y superficies, incluyendo aquellas áreas de difícil acceso como debajo de muebles, detrás de electrodomésticos y rincones ocultos. Ideal para mudanzas o después de eventos.', 1),
('Limpieza de alfombras', 'Servicio de lavado y mantenimiento de alfombras y tapicería utilizando técnicas como la limpieza en seco o con vapor para remover manchas, olores y alérgenos, extendiendo la vida útil de las alfombras.', 1),
('Desinfección de ambientes', 'Limpieza profunda y desinfección de espacios utilizando productos aprobados para la eliminación de bacterias, virus y hongos, ideal para prevenir la propagación de enfermedades en oficinas, hogares y hospitales.', 1),
('Limpieza post-construcción', 'Servicio especializado en la limpieza de obras y remodelaciones, removiendo polvo, escombros y residuos de construcción para entregar el espacio listo para su uso o habitabilidad.', 1),
('Limpieza de garajes', 'Limpieza profesional de garajes, incluyendo la eliminación de manchas de aceite, polvo acumulado, y basura. Se ofrece para garajes residenciales, comerciales y estacionamientos públicos.', 1),
('Limpieza de áreas verdes', 'Mantenimiento y limpieza de jardines y áreas verdes, que incluye la poda de césped, recolección de hojas y residuos, así como la limpieza de fuentes y senderos para mantener un espacio exterior impecable.', 1),
('Mensajería urbana', 'Servicio de entrega rápida de documentos y pequeños paquetes dentro de la misma ciudad, con seguimiento en tiempo real y entregas garantizadas el mismo día.', 2),
('Transporte de mercancías', 'Transporte de productos y mercancías comerciales entre ciudades o regiones, asegurando el cuidado y protección de los bienes durante el trayecto con vehículos acondicionados.', 2),
('Alquiler de vehículos de carga', 'Servicio de alquiler de camiones y furgonetas para transporte de carga pesada o voluminosa, ideal para mudanzas o traslados de mercancías empresariales.', 2),
('Transporte exprés', 'Servicio de transporte rápido para entregas urgentes con tiempos de respuesta reducidos. Ideal para empresas que necesitan enviar productos o documentos en plazos muy cortos.', 2),
('Transporte de muebles', 'Especializado en el traslado de muebles de todo tipo, con personal capacitado para desarmar, proteger y reensamblar muebles en el destino. Ofrecemos cobertura local y nacional.', 2),
('Transporte refrigerado', 'Transporte de productos perecederos o que requieren condiciones de refrigeración controladas, tales como alimentos, medicamentos y productos biotecnológicos.', 2),
('Mudanzas', 'Servicio de mudanza completo, que incluye el embalaje, carga, transporte y descarga de pertenencias, ofreciendo seguros de transporte para proteger los bienes durante el traslado.', 2),
('Transporte de maquinaria', 'Transporte especializado para maquinaria pesada utilizada en construcción, minería o agricultura, asegurando un manejo seguro y cumplimiento de las normativas de tránsito.', 2),
('Transporte de productos químicos', 'Servicio especializado en el traslado de productos químicos o materiales peligrosos, cumpliendo con estrictas normativas de seguridad y utilizando vehículos certificados para evitar riesgos.', 2),
('Transporte especializado', 'Transporte de mercancías frágiles, delicadas o de valor, como obras de arte, equipos médicos, y productos electrónicos, con embalaje y manipulación especializados.', 2),
('Consultoría legal', 'Asesoría profesional en materia legal para individuos y empresas. Se cubren áreas como derecho civil, comercial, laboral, y penal, garantizando orientación precisa para tomar decisiones informadas.', 3),
('Consultoría financiera', 'Servicios de consultoría enfocados en la planificación financiera, gestión de inversiones y análisis de riesgos, con el objetivo de optimizar el rendimiento financiero a corto y largo plazo.', 3),
('Consultoría de recursos humanos', 'Asesoría en la gestión de talento humano, incluyendo reclutamiento, evaluación de desempeño, capacitación y retención de empleados, ayudando a mejorar la productividad empresarial.', 3),
('Consultoría en marketing', 'Desarrollo de estrategias de marketing digital y tradicional para empresas, con el objetivo de mejorar la visibilidad de la marca, captar nuevos clientes y aumentar las ventas a través de campañas personalizadas.', 3),
('Consultoría en tecnología', 'Asesoría en la implementación de soluciones tecnológicas innovadoras, desde la elección de software hasta la integración de sistemas de inteligencia artificial y automatización de procesos.', 3),
('Consultoría en gestión empresarial', 'Consultoría orientada a mejorar la eficiencia operativa de las empresas mediante la optimización de procesos, reingeniería de operaciones y diseño de estrategias de crecimiento.', 3),
('Consultoría en sostenibilidad', 'Asesoría en la implementación de prácticas empresariales sostenibles que respeten el medio ambiente, optimicen los recursos naturales y mejoren la reputación corporativa.', 3),
('Consultoría en seguridad informática', 'Consultoría en ciberseguridad, ofreciendo soluciones para proteger redes, sistemas y datos contra ataques cibernéticos, así como implementación de políticas de seguridad.', 3),
('Consultoría en comercio internacional', 'Asesoría para empresas que buscan expandirse a mercados internacionales, proporcionando análisis de mercados, recomendaciones sobre aduanas y normativas internacionales.', 3),
('Consultoría en gestión de proyectos', 'Asesoría en la planificación, ejecución y control de proyectos complejos, aplicando metodologías como Agile o PMI para asegurar el cumplimiento de plazos y presupuestos.', 3),
('Limpieza de hospitales', 'Limpieza y desinfección en áreas médicas y quirúrgicas de hospitales y clínicas, cumpliendo con los más altos estándares de higiene y bioseguridad para evitar la propagación de infecciones.', 1),
('Limpieza de centros comerciales', 'Servicio de mantenimiento y limpieza de grandes áreas comerciales, asegurando la limpieza continua de áreas comunes, baños, pasillos y espacios de alto tránsito de personas.', 1),
('Limpieza de piscinas', 'Limpieza y tratamiento de piscinas, incluyendo la remoción de impurezas, control del nivel de pH y aplicación de productos químicos seguros para mantener el agua limpia y cristalina.', 1),
('Limpieza de cocinas industriales', 'Limpieza especializada en cocinas de restaurantes y hoteles, asegurando la correcta desinfección de equipos, superficies de trabajo y zonas de almacenamiento de alimentos.', 1),
('Limpieza de autos', 'Servicio de lavado y detallado de vehículos, con atención a la limpieza exterior e interior, restauración de tapicería y eliminación de manchas o suciedad incrustada.', 1),
('Limpieza de barcos', 'Mantenimiento y limpieza de embarcaciones, incluyendo la limpieza de cubiertas, interiores, y el mantenimiento de áreas de maquinaria, garantizando la preservación de los materiales.', 1),
('Limpieza de escuelas', 'Servicio de limpieza y desinfección de colegios y universidades, con especial enfoque en la limpieza de aulas, áreas comunes, baños y laboratorios para garantizar un entorno seguro para los estudiantes.', 1),
('Limpieza de almacenes', 'Limpieza de áreas de almacenamiento y depósitos, incluyendo la eliminación de polvo, suciedad y residuos para mantener un espacio de almacenamiento limpio y organizado.', 1),
('Limpieza en eventos', 'Servicio de limpieza antes, durante y después de eventos como conferencias, bodas o conciertos, asegurando que el lugar quede impecable antes y después de su uso.', 1),
('Limpieza de centros deportivos', 'Mantenimiento y limpieza de gimnasios, canchas deportivas y áreas de entrenamiento, asegurando la correcta desinfección de equipos y superficies para garantizar la seguridad de los usuarios.', 1),
('Transporte de animales', 'Transporte seguro de animales vivos, con vehículos adaptados para mantener condiciones óptimas durante el traslado de mascotas, ganado u otros animales.', 2),
('Transporte de pasajeros VIP', 'Servicio exclusivo de transporte para pasajeros VIP con vehículos de lujo y choferes altamente capacitados para ofrecer un viaje cómodo y discreto.', 2),
('Transporte turístico', 'Servicio de transporte especializado para turistas, con rutas personalizadas que incluyen visitas guiadas a destinos turísticos populares.', 2),
('Servicio de courier internacional', 'Entrega de documentos y paquetes a nivel internacional, con seguimiento en tiempo real y servicios de aduanas para garantizar una entrega rápida y segura.', 2),
('Alquiler de furgonetas', 'Alquiler de furgonetas para transporte de carga o grupos de pasajeros, con diferentes tamaños y capacidades según las necesidades del cliente.', 2),
('Transporte escolar', 'Servicio de transporte seguro y confiable para estudiantes, asegurando el cumplimiento de todas las normativas de seguridad y confort.', 2),
('Logística integral', 'Soluciones logísticas completas para empresas, que incluyen el transporte, almacenamiento y distribución de mercancías a nivel local, nacional e internacional.', 2),
('Entrega de comida a domicilio', 'Servicio de entrega rápida de comida preparada a domicilio, ofreciendo opciones de seguimiento en tiempo real y entrega en menos de una hora.', 2),
('Alquiler de autos con chofer', 'Servicio de alquiler de vehículos con chofer privado para transporte personalizado dentro y fuera de la ciudad.', 2),
('Transporte en ambulancia', 'Servicio de transporte médico en ambulancias equipadas para emergencias o traslados de pacientes a hospitales o centros de salud.', 2),
('Consultoría en inteligencia artificial', 'Asesoría para la implementación de tecnologías de inteligencia artificial en procesos empresariales, desde la automatización hasta el análisis predictivo, mejorando la eficiencia y la toma de decisiones.', 3),
('Consultoría en big data', 'Servicio de consultoría para empresas que buscan aprovechar grandes volúmenes de datos, ofreciendo análisis avanzados para identificar patrones y mejorar la toma de decisiones.', 3),
('Consultoría en transformación digital', 'Asesoría para la transformación digital de negocios, optimizando procesos y adoptando nuevas tecnologías para mejorar la eficiencia y competitividad en el mercado actual.', 3),
('Consultoría en gestión de crisis', 'Asesoramiento especializado en la gestión de crisis empresariales, incluyendo la planificación y ejecución de estrategias para mitigar riesgos y gestionar situaciones críticas.', 3),
('Consultoría en protección de datos', 'Consultoría en la protección y privacidad de datos personales y empresariales, cumpliendo con las normativas internacionales y locales como el RGPD.', 3),
('Consultoría en responsabilidad social', 'Asesoría para empresas que buscan implementar estrategias de responsabilidad social corporativa, mejorando su impacto social y ambiental a través de iniciativas sostenibles.', 3),
('Consultoría en recursos naturales', 'Asesoría en la gestión y explotación sostenible de recursos naturales, optimizando su uso en sectores como la agricultura, minería y energía.', 3),
('Consultoría en gestión ambiental', 'Asesoría para empresas en la adopción de prácticas ambientalmente responsables, incluyendo la reducción de emisiones, gestión de residuos y uso eficiente de recursos.', 3),
('Consultoría en energías renovables', 'Asesoría para la implementación de proyectos de energías renovables como solar, eólica e hidroeléctrica, ayudando a las empresas a reducir su huella de carbono y costos energéticos.', 3),
('Consultoría en diseño organizacional', 'Asesoría para la reestructuración organizacional, optimizando la eficiencia interna, el flujo de trabajo y la comunicación entre los distintos departamentos de la empresa.', 3);

INSERT INTO usuarios (nombre, apellido, correo, telefono, direccion, username, password, id_tipo, id_ubicacion) VALUES
('daniel', 'gonzalez', 'daniel.gonzalezubaque@gmail.com', '', '1370', 'daniel', '$2y$10$1KQLBTrx8iiLgQVwPL509eEXam6eYxr5edAYceZhiHiMh48/B4taq', 1, 1),
('juan', 'perez', 'jp@gmail.com', '671284672', 'carrera 10', 'juan', '$2y$10$N/aAGj6XkJiR75pOj2XvA.dWZdqs4lGeMObyRK5YrjH7FkJCyrQwm', 2, 1);

INSERT INTO solicitud_servicios (fecha_apertura, fecha_cierre, precio_ofertado, descripcion, id_ubicacion, id_servicio, id_usuario) VALUES
('2024-10-01 00:00:00', NULL, 100, 'Nuestro equipo de limpieza está capacitado para realizar una limpieza profunda de casas, asegurando que cada rincón esté impecable. Usamos productos ecológicos y técnicas profesionales para garantizar un ambiente saludable para usted y su familia. La limpieza incluye desinfección de baños, cocina y áreas comunes, así como atención especial a los detalles.', 1, 1, 2),
('2024-10-03 00:00:00', NULL, 300, 'Realizamos limpieza en fábricas con un enfoque en la seguridad y la eficiencia. Nuestro equipo especializado utiliza equipos y técnicas adecuadas para eliminar residuos industriales y polvo, cumpliendo con las normativas de higiene. Estamos comprometidos con mantener sus instalaciones en condiciones óptimas para el trabajo.', 1, 3, 2),
('2024-10-06 00:00:00', NULL, 120, 'Nuestro servicio de limpieza de alfombras incluye lavado a vapor y tratamiento de manchas. Utilizamos productos específicos que no solo limpian, sino que también protegen sus alfombras de futuros daños. Ideal para hogares y oficinas con alta circulación.', 1, 6, 2),
('2024-10-07 00:00:00', NULL, 250, 'Ofrecemos un servicio de desinfección de ambientes, aplicando productos aprobados que eliminan virus y bacterias. Ideal para empresas y hogares que buscan un ambiente seguro, especialmente en tiempos de alta preocupación sanitaria.', 1, 7, 2),
('2024-10-08 00:00:00', NULL, 400, 'Después de una construcción o remodelación, nuestro equipo realiza una limpieza post-construcción completa. Nos encargamos de eliminar el polvo y los escombros, dejando su espacio listo para ser utilizado. Este servicio incluye la limpieza de ventanas y superficies.', 1, 8, 2),
('2024-10-09 00:00:00', NULL, 80, 'Nuestro servicio de limpieza de garajes se encarga de eliminar el polvo, manchas de aceite y desechos acumulados. Ofrecemos un mantenimiento regular para mantener su garaje limpio y funcional.', 1, 9, 2),
('2024-10-10 00:00:00', NULL, 180, 'Con nuestro servicio de limpieza de áreas verdes, aseguramos que su jardín y espacios exteriores estén siempre cuidados. Incluimos servicios de poda, recolección de hojas y mantenimiento general para que disfrute de un espacio agradable y bien cuidado.', 1, 10, 2),
('2024-10-11 00:00:00', NULL, 50, 'Ofrecemos mensajería urbana eficiente, con entregas rápidas y seguimiento en tiempo real. Nuestro equipo garantiza que sus documentos y paquetes lleguen a tiempo y en perfectas condiciones.', 1, 11, 2),
('2024-10-12 00:00:00', NULL, 200, 'Transporte de mercancías seguro y confiable. Nos encargamos del manejo y traslado de sus productos, asegurando que lleguen a su destino sin daños. Utilizamos vehículos acondicionados para diferentes tipos de carga.', 1, 12, 2),
('2024-10-13 00:00:00', NULL, 250, 'Alquiler de vehículos de carga con chofer, ideal para mudanzas o transporte de mercancías. Nuestros choferes están capacitados para manejar cargas pesadas con seguridad y eficiencia.', 1, 13, 2),
('2024-10-14 00:00:00', NULL, 300, 'Con nuestro servicio de transporte exprés, garantizamos entregas urgentes en plazos reducidos. Ideal para empresas que necesitan enviar documentos o productos en poco tiempo.', 1, 14, 2),
('2024-10-15 00:00:00', NULL, 150, 'Ofrecemos un servicio de transporte de muebles, asegurando que sus pertenencias lleguen a su destino en perfectas condiciones. Nuestro equipo se encarga del embalaje y el transporte de muebles de todo tipo.', 1, 15, 2),
('2024-10-16 00:00:00', NULL, 400, 'Nuestro servicio de transporte refrigerado es ideal para productos perecederos. Garantizamos condiciones óptimas de temperatura y manipulación para mantener la calidad de sus mercancías.', 1, 16, 2),
('2024-10-17 00:00:00', NULL, 500, 'Realizamos mudanzas completas, encargándonos del embalaje, carga, transporte y descarga de sus pertenencias. Ofrecemos seguros de transporte para proteger sus bienes durante el traslado.', 1, 17, 2),
('2024-10-18 00:00:00', NULL, 600, 'Ofrecemos transporte especializado para maquinaria pesada, asegurando que cumplan con las normativas de tránsito y seguridad durante el traslado. Ideal para empresas de construcción y minería.', 1, 18, 2),
('2024-10-19 00:00:00', NULL, 350, 'Transporte de productos químicos con vehículos certificados, cumpliendo con las normativas de seguridad para evitar riesgos durante el traslado. Nuestros choferes están capacitados para manejar materiales peligrosos.', 1, 19, 2),
('2024-10-20 00:00:00', NULL, 400, 'Transporte de mercancías frágiles y delicadas, con atención especial a la protección durante el viaje. Ideal para obras de arte y equipos sensibles, aseguramos que lleguen en perfectas condiciones.', 1, 20, 2),
('2024-10-21 00:00:00', NULL, 150, 'Ofrecemos consultoría legal completa, abordando todos sus requerimientos legales con un enfoque profesional y personalizado. Nuestro equipo de abogados se encargará de guiarlo en cada paso del proceso.', 1, 21, 2),
('2024-10-22 00:00:00', NULL, 300, 'Nuestro servicio de consultoría financiera se enfoca en la planificación y gestión de sus recursos, ayudándole a maximizar su rentabilidad y minimizar riesgos. Trabajamos con usted para desarrollar estrategias efectivas.', 1, 22, 2),
('2024-10-23 00:00:00', NULL, 200, 'Brindamos consultoría en recursos humanos, ayudándole a optimizar la gestión de su personal. Desde reclutamiento hasta evaluación de desempeño, nuestro equipo le ayudará a mejorar la productividad y el ambiente laboral.', 1, 23, 2),
('2024-10-24 00:00:00', NULL, 250, 'Nuestra consultoría en marketing le ofrecerá estrategias personalizadas para mejorar la visibilidad de su marca y captar nuevos clientes. Desde marketing digital hasta campañas tradicionales, estamos aquí para ayudarle.', 1, 24, 2),
('2024-10-25 00:00:00', NULL, 400, 'Ofrecemos consultoría en tecnología para ayudar a su empresa a adoptar soluciones innovadoras. Desde la elección de software hasta la implementación de sistemas avanzados, nuestro equipo está preparado para guiarle.', 1, 25, 2),
('2024-10-26 00:00:00', NULL, 350, 'Consultoría en gestión empresarial para ayudar a mejorar la eficiencia operativa y la competitividad. Ofrecemos un análisis detallado de sus procesos actuales y propuestas para optimizarlos.', 1, 26, 2),
('2024-10-27 00:00:00', NULL, 180, 'Brindamos consultoría en sostenibilidad, ayudando a su empresa a adoptar prácticas que respeten el medio ambiente y mejoren su reputación. Desarrollamos estrategias que favorezcan la sostenibilidad y la responsabilidad social.', 1, 27, 2),
('2024-10-28 00:00:00', NULL, 250, 'Ofrecemos consultoría en seguridad informática, ayudando a proteger sus sistemas y datos contra amenazas cibernéticas. Nuestro equipo evaluará sus actuales protocolos de seguridad y propondrá mejoras.', 1, 28, 2),
('2024-10-29 00:00:00', NULL, 400, 'Brindamos consultoría en comercio internacional, guiándole en su expansión a mercados extranjeros. Ofrecemos asesoría sobre normativas aduaneras y estrategias de entrada a nuevos mercados.', 1, 29, 2),
('2024-10-30 00:00:00', NULL, 220, 'Nuestra consultoría en gestión de proyectos le ayudará a planificar y ejecutar sus proyectos con éxito. Ofrecemos herramientas y técnicas para mejorar la organización y seguimiento de tareas.', 1, 30, 2);

INSERT INTO contratos (id_solicitud, id_usuario) VALUES
(6, 1),
(8, 1),
(8, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(3, 1),
(3, 1),
(3, 1);