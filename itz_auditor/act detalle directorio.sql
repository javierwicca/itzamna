insert into iau_detalle_directorio (ddi_identificacion,ddi_tipo_sociedad,ddi_tipo_regimen,ddi_autorretenedor,ddi_gc,ddi_sucursal,ddi_dir_sucursal,
  ddi_representante,ddi_retenedor_iva) 
  select cli_identificacion,cli_tipo_sociedad,cli_tipo_regimen,cli_autorretenedor,cli_gc,cli_sucursal,cli_dir_sucursal,
  cli_representante,cli_retenedor_iva from iau_clientes;
 insert into iau_detalle_directorio (ddi_identificacion,ddi_tipo_sociedad,ddi_tipo_regimen,ddi_autorretenedor,ddi_gc,ddi_sucursal,ddi_dir_sucursal,
  ddi_representante,ddi_retenedor_iva) 
  select prv_identificacion,prv_tipo_sociedad,prv_tipo_regimen,prv_autorretenedor,prv_gc,prv_sucursal,prv_dir_sucursal,
  prv_representante,prv_retenedor_iva from iau_proveedores
  where prv_identificacion not in (select cli_identificacion from iau_clientes);