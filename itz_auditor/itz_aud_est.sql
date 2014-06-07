

SET default_with_oids = false;

--
-- TOC entry 144 (class 1259 OID 15135888)
-- Name: iau_acceso_modulos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_acceso_modulos (
    amo_modulo integer NOT NULL,
    amo_usuario bigint NOT NULL,
    amo_fecha_hora timestamp(0) without time zone NOT NULL,
    amo_acceso "char" NOT NULL,
    amo_ip character varying(15)
);


ALTER TABLE public.iau_acceso_modulos OWNER TO postgres;

--
-- TOC entry 1927 (class 0 OID 0)
-- Dependencies: 144
-- Name: TABLE iau_acceso_modulos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_acceso_modulos IS 'Registro de acceso a los modulos.';


--
-- TOC entry 1928 (class 0 OID 0)
-- Dependencies: 144
-- Name: COLUMN iau_acceso_modulos.amo_modulo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_acceso_modulos.amo_modulo IS 'Codigo del modulo al cual se accede, relaciondo con mod_codigo en la tabla iau_modulos_menus.';


--
-- TOC entry 1929 (class 0 OID 0)
-- Dependencies: 144
-- Name: COLUMN iau_acceso_modulos.amo_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_acceso_modulos.amo_usuario IS 'Usuario que accede al menu, relacionado con usu_identificacion en la tabla iau_usuarios.';


--
-- TOC entry 1930 (class 0 OID 0)
-- Dependencies: 144
-- Name: COLUMN iau_acceso_modulos.amo_fecha_hora; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_acceso_modulos.amo_fecha_hora IS 'Fecha y hora en que se accede al modulo.';


--
-- TOC entry 1931 (class 0 OID 0)
-- Dependencies: 144
-- Name: COLUMN iau_acceso_modulos.amo_acceso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_acceso_modulos.amo_acceso IS 'Tipo de acceso; L-istar, A-dicion, M-odificacion,C-opiar, I-nactivación.';


--
-- TOC entry 1932 (class 0 OID 0)
-- Dependencies: 144
-- Name: COLUMN iau_acceso_modulos.amo_ip; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_acceso_modulos.amo_ip IS 'Direccion IP desde donde se accede';


--
-- TOC entry 160 (class 1259 OID 15309760)
-- Name: iau_bien_servicios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_bien_servicios (
    bse_consecutivo bigint NOT NULL,
    bse_bien_servicio character varying,
    bse_pr_retefuentej numeric(5,2),
    bse_pr_retefuenten numeric(5,2),
    bse_vl_uvt smallint,
    bse_pr_iva numeric(5,2),
    bse_pr_consumo numeric(5,2)
);


ALTER TABLE public.iau_bien_servicios OWNER TO postgres;

--
-- TOC entry 1933 (class 0 OID 0)
-- Dependencies: 160
-- Name: TABLE iau_bien_servicios; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_bien_servicios IS 'Relaciones de bienes y servicios.';


--
-- TOC entry 1934 (class 0 OID 0)
-- Dependencies: 160
-- Name: COLUMN iau_bien_servicios.bse_consecutivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_bien_servicios.bse_consecutivo IS 'Consecutivo del bien o servicio calculado por el sistema.';


--
-- TOC entry 1935 (class 0 OID 0)
-- Dependencies: 160
-- Name: COLUMN iau_bien_servicios.bse_bien_servicio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_bien_servicios.bse_bien_servicio IS 'Descripción del bien o servicio.';


--
-- TOC entry 1936 (class 0 OID 0)
-- Dependencies: 160
-- Name: COLUMN iau_bien_servicios.bse_pr_retefuentej; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_bien_servicios.bse_pr_retefuentej IS 'Porcentaje de retencion en la fuente persona juridica.';


--
-- TOC entry 1937 (class 0 OID 0)
-- Dependencies: 160
-- Name: COLUMN iau_bien_servicios.bse_pr_retefuenten; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_bien_servicios.bse_pr_retefuenten IS 'Porcentaje de retencion en la fuente persona natural.';


--
-- TOC entry 1938 (class 0 OID 0)
-- Dependencies: 160
-- Name: COLUMN iau_bien_servicios.bse_vl_uvt; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_bien_servicios.bse_vl_uvt IS 'Valor UVT.';


--
-- TOC entry 1939 (class 0 OID 0)
-- Dependencies: 160
-- Name: COLUMN iau_bien_servicios.bse_pr_iva; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_bien_servicios.bse_pr_iva IS 'Porcentaje de valor IVA.';


--
-- TOC entry 1940 (class 0 OID 0)
-- Dependencies: 160
-- Name: COLUMN iau_bien_servicios.bse_pr_consumo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_bien_servicios.bse_pr_consumo IS 'Porcentaje del impuesto al consumo.';


--
-- TOC entry 154 (class 1259 OID 15207460)
-- Name: iau_ciiu; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_ciiu (
    ciu_codigo character varying(10) NOT NULL,
    ciu_lugar character varying(11) NOT NULL,
    ciu_detalle text,
    ciu_tarifa numeric(10,6) NOT NULL,
    ciu_version character varying
);


ALTER TABLE public.iau_ciiu OWNER TO postgres;

--
-- TOC entry 1941 (class 0 OID 0)
-- Dependencies: 154
-- Name: TABLE iau_ciiu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_ciiu IS 'Tabla de ciiu por ciudades';


--
-- TOC entry 1942 (class 0 OID 0)
-- Dependencies: 154
-- Name: COLUMN iau_ciiu.ciu_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu.ciu_codigo IS 'Codigo Ciiu';


--
-- TOC entry 1943 (class 0 OID 0)
-- Dependencies: 154
-- Name: COLUMN iau_ciiu.ciu_lugar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu.ciu_lugar IS 'Codigo ciudad o lugar relacionada con tabla iau_lugares en el campo lug_codigo';


--
-- TOC entry 1944 (class 0 OID 0)
-- Dependencies: 154
-- Name: COLUMN iau_ciiu.ciu_detalle; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu.ciu_detalle IS 'Detalle Ciiu';


--
-- TOC entry 1945 (class 0 OID 0)
-- Dependencies: 154
-- Name: COLUMN iau_ciiu.ciu_tarifa; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu.ciu_tarifa IS 'Porcentaje Tarifa';


--
-- TOC entry 1946 (class 0 OID 0)
-- Dependencies: 154
-- Name: COLUMN iau_ciiu.ciu_version; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu.ciu_version IS 'Version del CIIU.';


--
-- TOC entry 155 (class 1259 OID 15207577)
-- Name: iau_ciiu_directorio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_ciiu_directorio (
    cdi_identificacion bigint NOT NULL,
    cdi_ciiu character varying(10) NOT NULL,
    cdi_lugar character varying(11) NOT NULL,
    cdi_principal boolean
);


ALTER TABLE public.iau_ciiu_directorio OWNER TO postgres;

--
-- TOC entry 1947 (class 0 OID 0)
-- Dependencies: 155
-- Name: TABLE iau_ciiu_directorio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_ciiu_directorio IS 'Almacena las actividades economicas de la personas o empresas.';


--
-- TOC entry 1948 (class 0 OID 0)
-- Dependencies: 155
-- Name: COLUMN iau_ciiu_directorio.cdi_identificacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu_directorio.cdi_identificacion IS 'Identificacion del usuario relacionado, con el campo dir_identificacion en la tabla iau_directorio.';


--
-- TOC entry 1949 (class 0 OID 0)
-- Dependencies: 155
-- Name: COLUMN iau_ciiu_directorio.cdi_ciiu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu_directorio.cdi_ciiu IS 'Codigo ciiu, relacion con la tabla iau_ciiu en el campo ciu_codigo.';


--
-- TOC entry 1950 (class 0 OID 0)
-- Dependencies: 155
-- Name: COLUMN iau_ciiu_directorio.cdi_lugar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu_directorio.cdi_lugar IS 'Codigo ciudad o lugar relacionada con tabla iau_lugares en el campo lug_codigo.';


--
-- TOC entry 1951 (class 0 OID 0)
-- Dependencies: 155
-- Name: COLUMN iau_ciiu_directorio.cdi_principal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_ciiu_directorio.cdi_principal IS 'Actividad economica principal.';


--
-- TOC entry 151 (class 1259 OID 15198147)
-- Name: iau_clientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_clientes (
    cli_identificacion bigint NOT NULL,
    cli_tipo_sociedad character varying(5),
    cli_autorretenedor boolean,
    cli_gc boolean,
    cli_sucursal character varying(11)[],
    cli_dir_sucursal character varying(100)[],
    cli_representante bigint,
    cli_estado "char",
    cli_tipo_regimen character varying(5),
    cli_retenedor_iva boolean,
    cli_retefuente_todos boolean DEFAULT false
);


ALTER TABLE public.iau_clientes OWNER TO postgres;

--
-- TOC entry 1952 (class 0 OID 0)
-- Dependencies: 151
-- Name: TABLE iau_clientes; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_clientes IS 'Tabla para manejo de clientes.';


--
-- TOC entry 1953 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_identificacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_identificacion IS 'Identificacion del usuario relacionado, con el campo dir_identificacion en la tabla iau_directorio.';


--
-- TOC entry 1954 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_tipo_sociedad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_tipo_sociedad IS 'Tipo de sociedad, relacionado con tabla parametros "TDSOC".';


--
-- TOC entry 1955 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_autorretenedor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_autorretenedor IS 'Si es autorretenedor';


--
-- TOC entry 1956 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_gc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_gc IS 'Si es gran contribuyente.';


--
-- TOC entry 1957 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_sucursal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_sucursal IS 'Codigo de la ciudad de sucursal.';


--
-- TOC entry 1958 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_dir_sucursal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_dir_sucursal IS 'Direccion de la sucursal';


--
-- TOC entry 1959 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_representante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_representante IS 'Identificacion del representante legal.';


--
-- TOC entry 1960 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_estado IS 'Estado del cliente; A-ctivo, I-nactivo.';


--
-- TOC entry 1961 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_tipo_regimen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_tipo_regimen IS 'Tipo de regimen, relacionado con la tabla parametros con parametro ''TDREG''.';


--
-- TOC entry 1962 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_retenedor_iva; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_retenedor_iva IS 'Si es retenedor de IVA.';


--
-- TOC entry 1963 (class 0 OID 0)
-- Dependencies: 151
-- Name: COLUMN iau_clientes.cli_retefuente_todos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_clientes.cli_retefuente_todos IS 'Retencion en la fuente para todos por poilitcas de la empresa, t: SI, F: NO';


--
-- TOC entry 159 (class 1259 OID 15308370)
-- Name: iau_detalle_pagos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_detalle_pagos (
    dpa_pago bigint NOT NULL,
    dpa_consecutivo integer NOT NULL,
    dpa_bien_servicio integer,
    dpa_valor bigint,
    dpa_info character varying
);


ALTER TABLE public.iau_detalle_pagos OWNER TO postgres;

--
-- TOC entry 1964 (class 0 OID 0)
-- Dependencies: 159
-- Name: TABLE iau_detalle_pagos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_detalle_pagos IS 'Relacion de bienes y serviciones del pago.';


--
-- TOC entry 1965 (class 0 OID 0)
-- Dependencies: 159
-- Name: COLUMN iau_detalle_pagos.dpa_pago; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_detalle_pagos.dpa_pago IS 'Consecutivo del pago relacionado con el campo pag_consecutivo en la tabla iau_pagos.';


--
-- TOC entry 1966 (class 0 OID 0)
-- Dependencies: 159
-- Name: COLUMN iau_detalle_pagos.dpa_consecutivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_detalle_pagos.dpa_consecutivo IS 'Consecutivo del detalle en el pago.';


--
-- TOC entry 1967 (class 0 OID 0)
-- Dependencies: 159
-- Name: COLUMN iau_detalle_pagos.dpa_bien_servicio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_detalle_pagos.dpa_bien_servicio IS 'Consecutivo del bien o servicio relacionado con el campo bse_consecutivo en la tabla iau_bien_servicios.';


--
-- TOC entry 1968 (class 0 OID 0)
-- Dependencies: 159
-- Name: COLUMN iau_detalle_pagos.dpa_valor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_detalle_pagos.dpa_valor IS 'Valor del bien o servicio.';


--
-- TOC entry 1969 (class 0 OID 0)
-- Dependencies: 159
-- Name: COLUMN iau_detalle_pagos.dpa_info; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_detalle_pagos.dpa_info IS 'Información sobre detalle de los impuestos cobrados.';


--
-- TOC entry 146 (class 1259 OID 15135963)
-- Name: iau_directorio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_directorio (
    dir_identificacion bigint NOT NULL,
    dir_tipo_documento character varying(5) NOT NULL,
    dir_lugar_documento character varying(11),
    dir_digito_v "char",
    dir_tipo_persona "char",
    dir_apellidos character varying(50),
    dir_nombres character varying(70),
    dir_direccion character varying(100)[],
    dir_telefono character varying(14)[],
    dir_correo character varying(70),
    dir_ciudad_direccion character varying(11)[],
    dir_barrio character varying(30)[],
    dir_fecha_nac date,
    dir_lugar_nac character varying(11),
    dir_estado "char" DEFAULT 'A'::"char"
);


ALTER TABLE public.iau_directorio OWNER TO postgres;

--
-- TOC entry 1970 (class 0 OID 0)
-- Dependencies: 146
-- Name: TABLE iau_directorio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_directorio IS 'Directorio de personas naturales y juridicas';


--
-- TOC entry 1971 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_identificacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_identificacion IS 'Documento de identificacion';


--
-- TOC entry 1972 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_tipo_documento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_tipo_documento IS 'Tipo de documento de identificacion, relacionado con tabla parametros "TDIDE"';


--
-- TOC entry 1973 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_lugar_documento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_lugar_documento IS 'Lugar de expedicion del documento de identificacion, relacionado con lug_codigo en la tabla de iau_lugares';


--
-- TOC entry 1974 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_digito_v; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_digito_v IS 'Digito de verificacion del documento de identificacion';


--
-- TOC entry 1975 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_tipo_persona; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_tipo_persona IS 'Tipo de persona: N=Natural, J=Juridica';


--
-- TOC entry 1976 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_apellidos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_apellidos IS 'Apellidos de la persona';


--
-- TOC entry 1977 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_nombres; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_nombres IS 'Nombres de la persona';


--
-- TOC entry 1978 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_direccion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_direccion IS 'Arreglo para direcciones: posicion0=residencia, 1=correspondencia, 2=contacto';


--
-- TOC entry 1979 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_telefono; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_telefono IS 'Arreglo para telefonos: posicion0=celular, 1=fijo, 2=fax, 3 en adelante otros telefonos';


--
-- TOC entry 1980 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_correo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_correo IS 'Correo electronico';


--
-- TOC entry 1981 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_ciudad_direccion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_ciudad_direccion IS 'Arreglo para ciudades de direcciones: posicion0=residencia, 1=correspondencia, 2=contacto. Relacionado con lug_codigo en la tabla iau_ciudades.';


--
-- TOC entry 1982 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_barrio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_barrio IS 'Arreglo para barrios: posicion0=residencia, 1=correspondencia, 2=contacto';


--
-- TOC entry 1983 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_fecha_nac; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_fecha_nac IS 'Fecha de nacimiento';


--
-- TOC entry 1984 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_lugar_nac; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_lugar_nac IS 'Lugar de nacimiento, relacionado con lug_codgio en la tabla de iau_lugares.';


--
-- TOC entry 1985 (class 0 OID 0)
-- Dependencies: 146
-- Name: COLUMN iau_directorio.dir_estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_directorio.dir_estado IS 'Estado A-ctivo, I-nactivo';


--
-- TOC entry 161 (class 1259 OID 15362238)
-- Name: iau_doc_pagos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_doc_pagos (
    dpa_pago bigint NOT NULL,
    dpa_consecutivo integer NOT NULL,
    dpa_tipo_documento character varying(5) NOT NULL,
    dpa_num_documento character varying(15),
    dpa_detalle character varying(50)
);


ALTER TABLE public.iau_doc_pagos OWNER TO postgres;

--
-- TOC entry 1986 (class 0 OID 0)
-- Dependencies: 161
-- Name: TABLE iau_doc_pagos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_doc_pagos IS 'Tabla Documentos pagos';


--
-- TOC entry 1987 (class 0 OID 0)
-- Dependencies: 161
-- Name: COLUMN iau_doc_pagos.dpa_pago; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_pagos.dpa_pago IS 'Consecutivo del pago, con el campo pag_consecutivo en la tabla iau_pagos.';


--
-- TOC entry 1988 (class 0 OID 0)
-- Dependencies: 161
-- Name: COLUMN iau_doc_pagos.dpa_consecutivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_pagos.dpa_consecutivo IS 'Consecutivo del documento pago.';


--
-- TOC entry 1989 (class 0 OID 0)
-- Dependencies: 161
-- Name: COLUMN iau_doc_pagos.dpa_tipo_documento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_pagos.dpa_tipo_documento IS 'Tipo de documento, relacionado con tabla parametros "TDCPR"';


--
-- TOC entry 1990 (class 0 OID 0)
-- Dependencies: 161
-- Name: COLUMN iau_doc_pagos.dpa_num_documento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_pagos.dpa_num_documento IS 'Numero de documento';


--
-- TOC entry 1991 (class 0 OID 0)
-- Dependencies: 161
-- Name: COLUMN iau_doc_pagos.dpa_detalle; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_pagos.dpa_detalle IS 'descripcion del documento';


--
-- TOC entry 157 (class 1259 OID 15209110)
-- Name: iau_doc_proveedores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_doc_proveedores (
    dpr_identificacion bigint NOT NULL,
    dpr_tipo_documento character varying(5) NOT NULL,
    dpr_fecha_doc date NOT NULL,
    dpr_num_documento character varying(15),
    dpr_detalle character varying(50)
);


ALTER TABLE public.iau_doc_proveedores OWNER TO postgres;

--
-- TOC entry 1992 (class 0 OID 0)
-- Dependencies: 157
-- Name: TABLE iau_doc_proveedores; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_doc_proveedores IS 'Tabla Pago Proveedores';


--
-- TOC entry 1993 (class 0 OID 0)
-- Dependencies: 157
-- Name: COLUMN iau_doc_proveedores.dpr_identificacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_proveedores.dpr_identificacion IS 'Identificacion del proveedor relacionado, con el campo dir_identificacion en la tabla iau_directorio.';


--
-- TOC entry 1994 (class 0 OID 0)
-- Dependencies: 157
-- Name: COLUMN iau_doc_proveedores.dpr_tipo_documento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_proveedores.dpr_tipo_documento IS 'Tipo de documento, relacionado con tabla parametros "TDCPR"';


--
-- TOC entry 1995 (class 0 OID 0)
-- Dependencies: 157
-- Name: COLUMN iau_doc_proveedores.dpr_fecha_doc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_proveedores.dpr_fecha_doc IS 'fecha del documento';


--
-- TOC entry 1996 (class 0 OID 0)
-- Dependencies: 157
-- Name: COLUMN iau_doc_proveedores.dpr_num_documento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_proveedores.dpr_num_documento IS 'Numero de documento';


--
-- TOC entry 1997 (class 0 OID 0)
-- Dependencies: 157
-- Name: COLUMN iau_doc_proveedores.dpr_detalle; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_doc_proveedores.dpr_detalle IS 'descripcion del documento';


--
-- TOC entry 162 (class 1259 OID 15362447)
-- Name: iau_impuesto_pagos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_impuesto_pagos (
    ipa_pago bigint NOT NULL,
    ipa_impuesto character varying(5) NOT NULL,
    ipa_vl_impuesto integer
);


ALTER TABLE public.iau_impuesto_pagos OWNER TO postgres;

--
-- TOC entry 1998 (class 0 OID 0)
-- Dependencies: 162
-- Name: TABLE iau_impuesto_pagos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_impuesto_pagos IS 'Relacion de impuesto calculados en el pago.';


--
-- TOC entry 1999 (class 0 OID 0)
-- Dependencies: 162
-- Name: COLUMN iau_impuesto_pagos.ipa_pago; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_impuesto_pagos.ipa_pago IS 'Consecutivo del pago relacionado con el campo pag_consecutivo en la tabla iau_pagos.';


--
-- TOC entry 2000 (class 0 OID 0)
-- Dependencies: 162
-- Name: COLUMN iau_impuesto_pagos.ipa_impuesto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_impuesto_pagos.ipa_impuesto IS 'Codigo del impuesto relacionado en parametros "IMPUE".';


--
-- TOC entry 2001 (class 0 OID 0)
-- Dependencies: 162
-- Name: COLUMN iau_impuesto_pagos.ipa_vl_impuesto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_impuesto_pagos.ipa_vl_impuesto IS 'Valor del impuesto.';


--
-- TOC entry 147 (class 1259 OID 15135972)
-- Name: iau_lugares; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_lugares (
    lug_codigo character varying(11) NOT NULL,
    lug_nombre character varying(50),
    lug_tipo "char"
);


ALTER TABLE public.iau_lugares OWNER TO postgres;

--
-- TOC entry 2002 (class 0 OID 0)
-- Dependencies: 147
-- Name: TABLE iau_lugares; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_lugares IS 'Listado paises, departamentos y ciudades.';


--
-- TOC entry 2003 (class 0 OID 0)
-- Dependencies: 147
-- Name: COLUMN iau_lugares.lug_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_lugares.lug_codigo IS 'Codigo del lugar';


--
-- TOC entry 2004 (class 0 OID 0)
-- Dependencies: 147
-- Name: COLUMN iau_lugares.lug_nombre; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_lugares.lug_nombre IS 'Nombre del lugar';


--
-- TOC entry 2005 (class 0 OID 0)
-- Dependencies: 147
-- Name: COLUMN iau_lugares.lug_tipo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_lugares.lug_tipo IS 'Tipo de lugar: P=Pais, C=Ciudad, D=Departamento';


--
-- TOC entry 143 (class 1259 OID 15135865)
-- Name: iau_modificador_tablas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_modificador_tablas (
    mta_tabla character varying NOT NULL,
    mta_llave character varying NOT NULL,
    mta_consecutivo bigint NOT NULL,
    mta_usuario bigint,
    mta_fecha_hora timestamp(0) without time zone,
    mta_datos_anterior character varying,
    mta_datos_despues character varying
);


ALTER TABLE public.iau_modificador_tablas OWNER TO postgres;

--
-- TOC entry 2006 (class 0 OID 0)
-- Dependencies: 143
-- Name: TABLE iau_modificador_tablas; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_modificador_tablas IS 'Registro de modificacion o insercion en las tablas. ';


--
-- TOC entry 2007 (class 0 OID 0)
-- Dependencies: 143
-- Name: COLUMN iau_modificador_tablas.mta_tabla; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modificador_tablas.mta_tabla IS 'Nombre de la tabla la cual se esta afectando.';


--
-- TOC entry 2008 (class 0 OID 0)
-- Dependencies: 143
-- Name: COLUMN iau_modificador_tablas.mta_llave; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modificador_tablas.mta_llave IS 'Datos de la llave primaria de la tabla que se esta afeectando, si son varias columnas deben ir separadas por ##.';


--
-- TOC entry 2009 (class 0 OID 0)
-- Dependencies: 143
-- Name: COLUMN iau_modificador_tablas.mta_consecutivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modificador_tablas.mta_consecutivo IS 'Consecutivo de registros, el 1 es para inserción de hay en adelante es modificacion.';


--
-- TOC entry 2010 (class 0 OID 0)
-- Dependencies: 143
-- Name: COLUMN iau_modificador_tablas.mta_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modificador_tablas.mta_usuario IS 'Usuario que esta afectando la tabla, relacionado con el campo usu_identificacion en la tabla iau_usuarios.';


--
-- TOC entry 2011 (class 0 OID 0)
-- Dependencies: 143
-- Name: COLUMN iau_modificador_tablas.mta_fecha_hora; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modificador_tablas.mta_fecha_hora IS 'Fecha y hora en que se afecta la tabla.';


--
-- TOC entry 2012 (class 0 OID 0)
-- Dependencies: 143
-- Name: COLUMN iau_modificador_tablas.mta_datos_anterior; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modificador_tablas.mta_datos_anterior IS 'Datos del registro antes de la modificacion.';


--
-- TOC entry 2013 (class 0 OID 0)
-- Dependencies: 143
-- Name: COLUMN iau_modificador_tablas.mta_datos_despues; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modificador_tablas.mta_datos_despues IS 'Datos del registro depues de la modificacion.';


--
-- TOC entry 150 (class 1259 OID 15136006)
-- Name: iau_modulos_menus; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_modulos_menus (
    mme_codigo smallint NOT NULL,
    mme_nombre character varying(30),
    mme_nombre_mostrar character varying(30),
    mme_modulo character varying(5) NOT NULL,
    mme_pagina character varying(30),
    mme_imagen character varying(30),
    mme_menu_sup character varying,
    mme_orden smallint
);


ALTER TABLE public.iau_modulos_menus OWNER TO postgres;

--
-- TOC entry 2014 (class 0 OID 0)
-- Dependencies: 150
-- Name: TABLE iau_modulos_menus; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_modulos_menus IS 'Manejo de modulos y menus';


--
-- TOC entry 2015 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_codigo IS 'Codigo del menu';


--
-- TOC entry 2016 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_nombre; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_nombre IS 'Nombre del menu';


--
-- TOC entry 2017 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_nombre_mostrar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_nombre_mostrar IS 'Nombre a mostrar en el menu al usuario';


--
-- TOC entry 2018 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_modulo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_modulo IS 'Codigo del modulo al que pertenece el menu; relacionado con parametros "MODUL"';


--
-- TOC entry 2019 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_pagina; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_pagina IS 'Pagina a la cual llama el menu';


--
-- TOC entry 2020 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_imagen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_imagen IS 'Nombre del archivo de imagen del modulo';


--
-- TOC entry 2021 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_menu_sup; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_menu_sup IS 'Nombre del menu superior';


--
-- TOC entry 2022 (class 0 OID 0)
-- Dependencies: 150
-- Name: COLUMN iau_modulos_menus.mme_orden; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_modulos_menus.mme_orden IS 'Orden en el cual se muestra el menu al usuario';


--
-- TOC entry 158 (class 1259 OID 15308362)
-- Name: iau_pagos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_pagos (
    pag_consecutivo bigint NOT NULL,
    pag_cliente bigint,
    pag_proveedor bigint,
    pag_banco character varying(5),
    pag_cta_bancaria character varying(30),
    pag_tipo_cuenta "char",
    pag_fecha date,
    pag_no_documento character varying(15),
    pag_vl_pago bigint,
    pag_observaciones character varying,
    pag_lugar character varying(11)
);


ALTER TABLE public.iau_pagos OWNER TO postgres;

--
-- TOC entry 2023 (class 0 OID 0)
-- Dependencies: 158
-- Name: TABLE iau_pagos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_pagos IS 'Relacion de revision pagos.';


--
-- TOC entry 2024 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_consecutivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_consecutivo IS 'Consecutivo del pago, calculado por el sistema.';


--
-- TOC entry 2025 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_cliente; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_cliente IS 'Numero de identificacion del cliente, relacionado con el campo cli_identificacion en la tabla iau_clientes.';


--
-- TOC entry 2026 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_proveedor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_proveedor IS 'Numero de indentificacion del proveedor, relacionado con el campo prv_identificacion en la tabla iau_proveedores.';


--
-- TOC entry 2027 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_banco; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_banco IS 'Codigo del relacionado, relacionado con tabla parametros "BANCO".';


--
-- TOC entry 2028 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_cta_bancaria; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_cta_bancaria IS 'Numero de cuenta de bancaria.';


--
-- TOC entry 2029 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_tipo_cuenta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_tipo_cuenta IS 'Tipo de cuenta A-horros, C-orriente.';


--
-- TOC entry 2030 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_fecha; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_fecha IS 'Fecha pago.';


--
-- TOC entry 2031 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_no_documento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_no_documento IS 'Numero de documento soporte del pago, ej: numero de factura, orden de giro, etc...';


--
-- TOC entry 2032 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_vl_pago; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_vl_pago IS 'Valor de pago generado por el cliente.';


--
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_observaciones; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_observaciones IS 'Observaciones.';


--
-- TOC entry 2034 (class 0 OID 0)
-- Dependencies: 158
-- Name: COLUMN iau_pagos.pag_lugar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_pagos.pag_lugar IS 'Lugar de pago, relacionado con el campo lug_codigo en la tabla iau_lugar.';


--
-- TOC entry 145 (class 1259 OID 15135955)
-- Name: iau_parametros; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_parametros (
    par_parametro character varying(5) NOT NULL,
    par_elemento character varying(5) NOT NULL,
    par_detalle character varying(80),
    par_caracter character varying(15)[],
    par_entero integer[],
    par_decimal double precision[]
);


ALTER TABLE public.iau_parametros OWNER TO postgres;

--
-- TOC entry 2035 (class 0 OID 0)
-- Dependencies: 145
-- Name: TABLE iau_parametros; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_parametros IS 'Manejo de parametros para tablas recursivas';


--
-- TOC entry 2036 (class 0 OID 0)
-- Dependencies: 145
-- Name: COLUMN iau_parametros.par_parametro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_parametros.par_parametro IS 'Codigo de tabla: "TABLA"=Codigo de tabla superior';


--
-- TOC entry 2037 (class 0 OID 0)
-- Dependencies: 145
-- Name: COLUMN iau_parametros.par_elemento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_parametros.par_elemento IS 'Codigo de elemento';


--
-- TOC entry 2038 (class 0 OID 0)
-- Dependencies: 145
-- Name: COLUMN iau_parametros.par_detalle; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_parametros.par_detalle IS 'Descripcion del registro';


--
-- TOC entry 2039 (class 0 OID 0)
-- Dependencies: 145
-- Name: COLUMN iau_parametros.par_caracter; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_parametros.par_caracter IS 'Arreglo para datos de tipo caracter';


--
-- TOC entry 2040 (class 0 OID 0)
-- Dependencies: 145
-- Name: COLUMN iau_parametros.par_entero; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_parametros.par_entero IS 'Arreglo para datos de tipo entero';


--
-- TOC entry 2041 (class 0 OID 0)
-- Dependencies: 145
-- Name: COLUMN iau_parametros.par_decimal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_parametros.par_decimal IS 'Arreglo para datos de tipo decimal';


--
-- TOC entry 153 (class 1259 OID 15198297)
-- Name: iau_permisos_excepcionales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_permisos_excepcionales (
    pex_usuario bigint NOT NULL,
    pex_modulo smallint NOT NULL,
    pex_consulta boolean DEFAULT true NOT NULL,
    pex_adicionar boolean DEFAULT false NOT NULL,
    pex_modificar boolean DEFAULT false NOT NULL,
    pex_eliminar boolean DEFAULT false NOT NULL,
    pex_empresa bigint
);


ALTER TABLE public.iau_permisos_excepcionales OWNER TO postgres;

--
-- TOC entry 2042 (class 0 OID 0)
-- Dependencies: 153
-- Name: TABLE iau_permisos_excepcionales; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_permisos_excepcionales IS 'Permisos excepcionales para los usuarios';


--
-- TOC entry 2043 (class 0 OID 0)
-- Dependencies: 153
-- Name: COLUMN iau_permisos_excepcionales.pex_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_permisos_excepcionales.pex_usuario IS 'Codigo de usuario, relacionado con usu_documento en la tabla iau_usuarios';


--
-- TOC entry 2044 (class 0 OID 0)
-- Dependencies: 153
-- Name: COLUMN iau_permisos_excepcionales.pex_modulo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_permisos_excepcionales.pex_modulo IS 'Codigo del modulo, relacionado con mod_codigo en la tabla iau_modulos_menus';


--
-- TOC entry 2045 (class 0 OID 0)
-- Dependencies: 153
-- Name: COLUMN iau_permisos_excepcionales.pex_consulta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_permisos_excepcionales.pex_consulta IS 'Permiso para consultar registros';


--
-- TOC entry 2046 (class 0 OID 0)
-- Dependencies: 153
-- Name: COLUMN iau_permisos_excepcionales.pex_adicionar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_permisos_excepcionales.pex_adicionar IS 'Permiso para adicionar registros';


--
-- TOC entry 2047 (class 0 OID 0)
-- Dependencies: 153
-- Name: COLUMN iau_permisos_excepcionales.pex_modificar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_permisos_excepcionales.pex_modificar IS 'Permiso para modificar registros';


--
-- TOC entry 2048 (class 0 OID 0)
-- Dependencies: 153
-- Name: COLUMN iau_permisos_excepcionales.pex_eliminar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_permisos_excepcionales.pex_eliminar IS 'Permiso para eliminar registros';


--
-- TOC entry 2049 (class 0 OID 0)
-- Dependencies: 153
-- Name: COLUMN iau_permisos_excepcionales.pex_empresa; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_permisos_excepcionales.pex_empresa IS 'Codigo de la empresa relacionado con la tabla de empresas';


--
-- TOC entry 156 (class 1259 OID 15209102)
-- Name: iau_proveedores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_proveedores (
    prv_identificacion bigint NOT NULL,
    prv_tipo_sociedad character varying(5),
    prv_tipo_regimen character varying(5),
    prv_autorretenedor boolean,
    prv_gc boolean,
    prv_sucursal character varying(11)[],
    prv_dir_sucursal character varying(100)[],
    prv_representante bigint,
    prv_retenedor_iva boolean,
    prv_estado "char",
    prv_profesion_liberal boolean
);


ALTER TABLE public.iau_proveedores OWNER TO postgres;

--
-- TOC entry 2050 (class 0 OID 0)
-- Dependencies: 156
-- Name: TABLE iau_proveedores; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_proveedores IS 'Tabla Proveedores';


--
-- TOC entry 2051 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_identificacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_identificacion IS 'Identificacion del proveedor relacionado, con el campo dir_identificacion en la tabla iau_directorio.';


--
-- TOC entry 2052 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_tipo_sociedad; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_tipo_sociedad IS 'Tipo de sociedad, relacionado con tabla parametros "TDSOC".';


--
-- TOC entry 2053 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_tipo_regimen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_tipo_regimen IS 'Tipo de regimen, relacionado con la tabla parametros con parametro "TDREG"';


--
-- TOC entry 2054 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_autorretenedor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_autorretenedor IS 'Si es autorretenedor';


--
-- TOC entry 2055 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_gc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_gc IS 'Si es gran contribuyente.';


--
-- TOC entry 2056 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_sucursal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_sucursal IS 'Codigo de la ciudad de sucursal.';


--
-- TOC entry 2057 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_dir_sucursal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_dir_sucursal IS 'Direccion de la sucursal';


--
-- TOC entry 2058 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_representante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_representante IS 'Identificacion del representante legal.';


--
-- TOC entry 2059 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_retenedor_iva; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_retenedor_iva IS 'Si es retenedor de IVA.';


--
-- TOC entry 2060 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_estado IS 'Estado del proveedor; A-ctivo, I-nactivo.';


--
-- TOC entry 2061 (class 0 OID 0)
-- Dependencies: 156
-- Name: COLUMN iau_proveedores.prv_profesion_liberal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_proveedores.prv_profesion_liberal IS 'Si es de profesion liberal aplica para persona natural y regimen comun, true: SI, false: NO.';


--
-- TOC entry 148 (class 1259 OID 15135978)
-- Name: iau_roles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_roles (
    rol_codigo integer NOT NULL,
    rol_nombre character varying(20),
    rol_estado "char"
);


ALTER TABLE public.iau_roles OWNER TO postgres;

--
-- TOC entry 2062 (class 0 OID 0)
-- Dependencies: 148
-- Name: TABLE iau_roles; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_roles IS 'Registro de roles.';


--
-- TOC entry 2063 (class 0 OID 0)
-- Dependencies: 148
-- Name: COLUMN iau_roles.rol_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles.rol_codigo IS 'Codigo del rol.';


--
-- TOC entry 2064 (class 0 OID 0)
-- Dependencies: 148
-- Name: COLUMN iau_roles.rol_nombre; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles.rol_nombre IS 'Nombre del rol.';


--
-- TOC entry 2065 (class 0 OID 0)
-- Dependencies: 148
-- Name: COLUMN iau_roles.rol_estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles.rol_estado IS 'Estado del rol; A-ctivo, I-nactivo.';


--
-- TOC entry 149 (class 1259 OID 15135993)
-- Name: iau_roles_permisos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_roles_permisos (
    rpe_rol bigint NOT NULL,
    rpe_modulo smallint NOT NULL,
    rpe_consulta boolean DEFAULT true NOT NULL,
    rpe_adicionar boolean DEFAULT false NOT NULL,
    rpe_modificar boolean DEFAULT false NOT NULL,
    rpe_eliminar boolean DEFAULT false NOT NULL
);


ALTER TABLE public.iau_roles_permisos OWNER TO postgres;

--
-- TOC entry 2066 (class 0 OID 0)
-- Dependencies: 149
-- Name: TABLE iau_roles_permisos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_roles_permisos IS 'Permisos para los roles';


--
-- TOC entry 2067 (class 0 OID 0)
-- Dependencies: 149
-- Name: COLUMN iau_roles_permisos.rpe_rol; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_permisos.rpe_rol IS 'Codigo de rol, relacionado con rol_codigo en la tabla iau_roles';


--
-- TOC entry 2068 (class 0 OID 0)
-- Dependencies: 149
-- Name: COLUMN iau_roles_permisos.rpe_modulo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_permisos.rpe_modulo IS 'Codigo del modulo, relacionado con mod_codigo en la tabla iau_modulos_menus';


--
-- TOC entry 2069 (class 0 OID 0)
-- Dependencies: 149
-- Name: COLUMN iau_roles_permisos.rpe_consulta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_permisos.rpe_consulta IS 'Permiso para consultar registros';


--
-- TOC entry 2070 (class 0 OID 0)
-- Dependencies: 149
-- Name: COLUMN iau_roles_permisos.rpe_adicionar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_permisos.rpe_adicionar IS 'Permiso para adicionar registros';


--
-- TOC entry 2071 (class 0 OID 0)
-- Dependencies: 149
-- Name: COLUMN iau_roles_permisos.rpe_modificar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_permisos.rpe_modificar IS 'Permiso para modificar registros';


--
-- TOC entry 2072 (class 0 OID 0)
-- Dependencies: 149
-- Name: COLUMN iau_roles_permisos.rpe_eliminar; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_permisos.rpe_eliminar IS 'Permiso para eliminar registros';


--
-- TOC entry 152 (class 1259 OID 15198262)
-- Name: iau_roles_usuarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_roles_usuarios (
    rus_id integer NOT NULL,
    rus_rol integer NOT NULL,
    rus_usuario bigint NOT NULL,
    rus_empresa bigint
);


ALTER TABLE public.iau_roles_usuarios OWNER TO postgres;

--
-- TOC entry 2073 (class 0 OID 0)
-- Dependencies: 152
-- Name: COLUMN iau_roles_usuarios.rus_rol; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_usuarios.rus_rol IS 'Codigo del rol ';


--
-- TOC entry 2074 (class 0 OID 0)
-- Dependencies: 152
-- Name: COLUMN iau_roles_usuarios.rus_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_usuarios.rus_usuario IS 'Usuario relacionado';


--
-- TOC entry 2075 (class 0 OID 0)
-- Dependencies: 152
-- Name: COLUMN iau_roles_usuarios.rus_empresa; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_roles_usuarios.rus_empresa IS 'Codigo de la empresa';


--
-- TOC entry 142 (class 1259 OID 15127113)
-- Name: iau_usuarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE iau_usuarios (
    usu_identificacion bigint NOT NULL,
    usu_correo character varying(100) NOT NULL,
    usu_estado "char" NOT NULL,
    usu_tipo_usuario "char",
    usu_clave character varying(35) NOT NULL,
    usu_requiere_cambio boolean
);


ALTER TABLE public.iau_usuarios OWNER TO postgres;

--
-- TOC entry 2076 (class 0 OID 0)
-- Dependencies: 142
-- Name: TABLE iau_usuarios; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE iau_usuarios IS 'Manejo de usuarios para ingreso.';


--
-- TOC entry 2077 (class 0 OID 0)
-- Dependencies: 142
-- Name: COLUMN iau_usuarios.usu_identificacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_usuarios.usu_identificacion IS 'Identificacion del usuario relacionado, con el campo dir_identificacion en la tabla iau_directorio.';


--
-- TOC entry 2078 (class 0 OID 0)
-- Dependencies: 142
-- Name: COLUMN iau_usuarios.usu_correo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_usuarios.usu_correo IS 'Correo electronico del usuario, para notificaciones del programa.';


--
-- TOC entry 2079 (class 0 OID 0)
-- Dependencies: 142
-- Name: COLUMN iau_usuarios.usu_estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_usuarios.usu_estado IS 'Estado del usuario; A-ctivo, I-nactivo.';


--
-- TOC entry 2080 (class 0 OID 0)
-- Dependencies: 142
-- Name: COLUMN iau_usuarios.usu_tipo_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_usuarios.usu_tipo_usuario IS 'Tipo de usuario; A-dministrador, S-uper usuario, U-suario.';


--
-- TOC entry 2081 (class 0 OID 0)
-- Dependencies: 142
-- Name: COLUMN iau_usuarios.usu_clave; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_usuarios.usu_clave IS 'Clave de ingreso del usuario.';


--
-- TOC entry 2082 (class 0 OID 0)
-- Dependencies: 142
-- Name: COLUMN iau_usuarios.usu_requiere_cambio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN iau_usuarios.usu_requiere_cambio IS 'Si requiere cambio de clave; true: Si, false: No.';


--
-- TOC entry 1883 (class 2606 OID 15135892)
-- Name: pk_acceso_modulos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY iau_acceso_modulos
    ADD CONSTRAINT pk_acceso_modulos PRIMARY KEY (amo_modulo, amo_usuario, amo_fecha_hora, amo_acceso);




--
-- TOC entry 1915 (class 2606 OID 15309767)
-- Name: pk_bien_servicios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_bien_servicios
    ADD CONSTRAINT pk_bien_servicios PRIMARY KEY (bse_consecutivo);


--
-- TOC entry 1903 (class 2606 OID 15207555)
-- Name: pk_ciiu; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_ciiu
    ADD CONSTRAINT pk_ciiu PRIMARY KEY (ciu_codigo, ciu_lugar);


--
-- TOC entry 1905 (class 2606 OID 15207581)
-- Name: pk_ciiu_directorio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_ciiu_directorio
    ADD CONSTRAINT pk_ciiu_directorio PRIMARY KEY (cdi_identificacion, cdi_ciiu, cdi_lugar);



--
-- TOC entry 1897 (class 2606 OID 15198154)
-- Name: pk_clientes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY iau_clientes
    ADD CONSTRAINT pk_clientes PRIMARY KEY (cli_identificacion);


--
-- TOC entry 1913 (class 2606 OID 15308374)
-- Name: pk_detalle_pagos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY iau_detalle_pagos
    ADD CONSTRAINT pk_detalle_pagos PRIMARY KEY (dpa_pago, dpa_consecutivo);



--
-- TOC entry 1887 (class 2606 OID 15135971)
-- Name: pk_directorio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_directorio
    ADD CONSTRAINT pk_directorio PRIMARY KEY (dir_identificacion);


--
-- TOC entry 1917 (class 2606 OID 15362242)
-- Name: pk_doc_pagos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_doc_pagos
    ADD CONSTRAINT pk_doc_pagos PRIMARY KEY (dpa_pago, dpa_consecutivo);


--
-- TOC entry 1909 (class 2606 OID 15209114)
-- Name: pk_iau_docprov; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_doc_proveedores
    ADD CONSTRAINT pk_iau_docprov PRIMARY KEY (dpr_identificacion, dpr_tipo_documento, dpr_fecha_doc);


--
-- TOC entry 1907 (class 2606 OID 15209109)
-- Name: pk_iau_prov; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_proveedores
    ADD CONSTRAINT pk_iau_prov PRIMARY KEY (prv_identificacion);


--
-- TOC entry 1919 (class 2606 OID 15362451)
-- Name: pk_impuesto_pagos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_impuesto_pagos
    ADD CONSTRAINT pk_impuesto_pagos PRIMARY KEY (ipa_pago, ipa_impuesto);


--
-- TOC entry 1889 (class 2606 OID 15135976)
-- Name: pk_lugares; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_lugares
    ADD CONSTRAINT pk_lugares PRIMARY KEY (lug_codigo);


--
-- TOC entry 1881 (class 2606 OID 15135872)
-- Name: pk_modificador_tablas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_modificador_tablas
    ADD CONSTRAINT pk_modificador_tablas PRIMARY KEY (mta_tabla, mta_llave, mta_consecutivo);


--
-- TOC entry 1895 (class 2606 OID 15136013)
-- Name: pk_modulos_menus; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_modulos_menus
    ADD CONSTRAINT pk_modulos_menus PRIMARY KEY (mme_codigo);


--
-- TOC entry 1911 (class 2606 OID 15308369)
-- Name: pk_pagos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_pagos
    ADD CONSTRAINT pk_pagos PRIMARY KEY (pag_consecutivo);


--
-- TOC entry 1885 (class 2606 OID 15135962)
-- Name: pk_parametros; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_parametros
    ADD CONSTRAINT pk_parametros PRIMARY KEY (par_parametro, par_elemento);


--
-- TOC entry 1901 (class 2606 OID 15198305)
-- Name: pk_permisos_excepcionales; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_permisos_excepcionales
    ADD CONSTRAINT pk_permisos_excepcionales PRIMARY KEY (pex_usuario, pex_modulo);


--
-- TOC entry 1891 (class 2606 OID 15135982)
-- Name: pk_roles; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_roles
    ADD CONSTRAINT pk_roles PRIMARY KEY (rol_codigo);



--
-- TOC entry 1893 (class 2606 OID 15136001)
-- Name: pk_roles_permisos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: ajuidx
--

ALTER TABLE ONLY iau_roles_permisos
    ADD CONSTRAINT pk_roles_permisos PRIMARY KEY (rpe_rol, rpe_modulo);




--
-- TOC entry 1899 (class 2606 OID 15198266)
-- Name: pk_roles_usuarios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_roles_usuarios
    ADD CONSTRAINT pk_roles_usuarios PRIMARY KEY (rus_rol, rus_usuario, rus_id);


--
-- TOC entry 1879 (class 2606 OID 15135862)
-- Name: pk_usuarios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: itzidx
--

ALTER TABLE ONLY iau_usuarios
    ADD CONSTRAINT pk_usuarios PRIMARY KEY (usu_identificacion);


--
-- TOC entry 1926 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2013-10-12 11:21:05

--
-- PostgreSQL database dump complete
--

