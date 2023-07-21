<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\AplicacionController;
use App\Http\Controllers\CodigoController;
use App\Http\Controllers\EspecificacionController;
use App\Http\Controllers\DistribuidorasController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\PaymantController;

use App\Http\Controllers\JetFilterController;
use App\Http\Controllers\LogoutController;

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\AireAutomotrizController;
use App\Http\Controllers\AireIndustrialController;
use App\Http\Controllers\CombustibleLineaController;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\SelladoController;

use App\Http\Controllers\AplicacionAgricola;
use App\Http\Controllers\AplicacionComercial;
use App\Http\Controllers\AplicacionCarretera;
use App\Http\Controllers\AplicacionLiviano;
use App\Http\Controllers\BusquedaAplicacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\MarcasController;

use App\Http\Controllers\EquivalenciaController;
use App\Http\Controllers\EstrategiasController;
use App\Http\Controllers\FiltroController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\GraficaController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TiposController;
use Illuminate\Auth\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//WebFilter
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/registrarse', [RegisterController::class, 'registrarse'])->name('registrarse');
Route::post('/registrarse', [RegisterController::class, 'crear'])->name('crear_usuario');
Route::get('/iniciar_sesion', [LoginController::class, 'iniciar_sesion'])->name('iniciar_sesion');
Route::post('/iniciar_sesion', [LoginController::class, 'ingresar_usuario'])->name('ingresar_usuario');
Route::post('/cerrar_sesion', [LoginController::class, 'cerrar_sesion'])->name('cerrar_sesion');

Route::get('/distribuidores', [HomeController::class, 'distribuidores'])->name('distribuidores.index');
Route::post('/busqueda_distribuidores', [HomeController::class, 'busqueda_distribuidores'])->name('busqueda_distribuidores');

Route::get('/documentos/{catalogo}', [HomeController::class, 'documentos'])->name('documentos');
Route::get('/descargas', [HomeController::class, 'descargas'])->name('descargas.index');
Route::post('/enviar_correo', [HomeController::class, 'enviar_correo'])->name('enviar_correo');
Route::post('/compras', [HomeController::class, 'carrito_compras'])->name('carrito_compras');
Route::get('/carrito', [HomeController::class, 'carrito'])->name('carrito');
Route::post('/carrito/eliminar/{id}', [HomeController::class, 'carrito_eliminar'])->name('carrito_eliminar');
Route::post('/lista/eliminar/{id}', [HomeController::class, 'lista_eliminar'])->name('lista_eliminar');
Route::get('/lista_deseos', [HomeController::class, 'lista_deseos'])->name('lista_deseos');
Route::post('/deseos', [HomeController::class, 'deseos'])->name('deseos');
Route::post('/pay', [PaymantController::class, 'pay'])->name('pay');
Route::get('/success', [PaymantController::class, 'success'])->name('pay.success');
Route::get('/error', [PaymantController::class, 'error'])->name('pay.error');

Route::get('/filtro', [FiltroController::class, 'filtro'])->name('filtro.index');

Route::get('/aplicaciones', [AplicacionController::class, 'aplicaciones'])->name('aplicaciones.index');
Route::post('/aplicaciones/marca', [AplicacionController::class, 'marca'])->name('aplicaciones.marca');
Route::post('/aplicaciones/tabla', [AplicacionController::class, 'tabla'])->name('aplicaciones.tabla');
Route::post('/aplicaciones/vehiculo', [AplicacionController::class, 'vehiculo'])->name('aplicaciones.vehiculo');
Route::post('/aplicaciones/filtro', [AplicacionController::class, 'filtro'])->name('aplicaciones.filtro');

Route::get('/codigo', [CodigoController::class, 'codigo'])->name('codigo.index');
Route::post('/codigos/busqueda', [CodigoController::class, 'busqueda'])->name('codigo.busqueda');

Route::get('/especificaciones', [EspecificacionController::class, 'especificaciones'])->name('especificaciones.index');
Route::post('/especificaciones/clase', [EspecificacionController::class, 'clase'])->name('especificaciones.clase');
Route::post('/especificaciones/tipo', [EspecificacionController::class, 'tipo'])->name('especificaciones.tipo');
Route::post('/especificaciones/tabla', [EspecificacionController::class, 'tabla'])->name('especificaciones.tabla');

Route::get('/lineas/aceite', [LineaController::class, 'lineas_aceite'])->name('lineas.aceite');
Route::get('/lineas/aire', [LineaController::class, 'lineas_aire'])->name('lineas.aire');
Route::get('/lineas/combustible', [LineaController::class, 'lineas_combustible'])->name('lineas.combustible');
Route::get('/lineas/fluidos', [LineaController::class, 'lineas_fluidos'])->name('lineas.fluidos');

Route::get('/nosotros/ayuda', [NosotrosController::class, 'ayuda'])->name('nosotros.ayuda');
Route::get('/nosotros/instrucciones_uso', [NosotrosController::class, 'instrucciones_uso'])->name('nosotros.instrucciones.uso');
Route::get('/nosotros/noticias', [NosotrosController::class, 'noticias'])->name('nosotros.noticias');

//JetFilter
Route::get('/jetfilter', [JetFilterController::class, 'index'])->name('jet-filter.index');
Route::get('/jetfilter/gestion', [JetFilterController::class, 'gestion'])->name('jet-filter.gestion');
Route::post('/jetfilter/validar', [JetFilterController::class, 'validar'])->name('jet-filter.validar');

Route::get('/jetfilter/sesion', [JetFilterController::class, 'sesion'])->name('jet-filter.sesion')->middleware('auth');

Route::post('/jetfilter/catalogo/categoria/tipo', [CatalogoController::class, 'seleccionar_tipo'])->name('jet-filter.catalogo.categoria.tipo')->middleware('auth');


Route::get('/jetfilter/catalogo', [CatalogoController::class, 'index'])->name('jet-filter.catalogo')->middleware('auth');
Route::post('/jetfilter/catalogo/cargar', [CatalogoController::class, 'cargarTabla'])->name('jet-filter.catalogo.cargar')->middleware('auth');
Route::post('/jetfilter/catalogo/cargar_aplicacion', [CatalogoController::class, 'cargarAplicacionTabla'])->name('jet-filter.catalogo.cargar_aplicacion')->middleware('auth');
Route::post('/jetfilter/catalogo/store', [CatalogoController::class, 'store'])->name('jet-filter.catalogo.store')->middleware('auth');
Route::put('/jetfilter/catalogo/update/{id}', [CatalogoController::class, 'update'])->name('jet-filter.catalogo.update')->middleware('auth');
Route::put('/jetfilter/catalogo/update_imagenes/{id}', [CatalogoController::class, 'update_imagenes'])->name('jet-filter.catalogo.update_imagenes')->middleware('auth');

Route::get('/jetfilter/catalogo/categorias', [CategoriaController::class, 'index'])->name('jet-filter.catalogo.categorias.index')->middleware('auth');
Route::post('/jetfilter/catalogo/categorias/cargar', [CategoriaController::class, 'cargar'])->name('jet-filter.catalogo.categorias.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/categorias/crear', [CategoriaController::class, 'crear'])->name('jet-filter.catalogo.categorias.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/categorias/store', [CategoriaController::class, 'store'])->name('jet-filter.catalogo.categorias.store')->middleware('auth');
Route::get('/jetfilter/catalogo/categorias/edit/{categoria}', [CategoriaController::class, 'edit'])->name('jet-filter.catalogo.categorias.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/categorias/update/{categoria}', [CategoriaController::class, 'update'])->name('jet-filter.catalogo.categorias.update')->middleware('auth');
Route::post('/jetfilter/catalogo/categorias/delete/{id}', [CategoriaController::class, 'delete'])->name('jet-filter.catalogo.categorias.delete')->middleware('auth');

Route::get('/jetfilter/catalogo/tipos', [TiposController::class, 'index'])->name('jet-filter.catalogo.tipos.index')->middleware('auth');
Route::post('/jetfilter/catalogo/tipos/cargar', [TiposController::class, 'cargar'])->name('jet-filter.catalogo.tipos.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/tipos/crear', [TiposController::class, 'crear'])->name('jet-filter.catalogo.tipos.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/tipos/store', [TiposController::class, 'store'])->name('jet-filter.catalogo.tipos.store')->middleware('auth');
Route::get('/jetfilter/catalogo/tipos/edit/{tipo}', [TiposController::class, 'edit'])->name('jet-filter.catalogo.tipos.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/tipos/update/{tipo}', [TiposController::class, 'update'])->name('jet-filter.catalogo.tipos.update')->middleware('auth');
Route::post('/jetfilter/catalogo/tipos/delete/{id}', [TiposController::class, 'delete'])->name('jet-filter.catalogo.tipos.delete')->middleware('auth');

Route::get('/jetfilter/catalogo/aireautomotriz', [AireAutomotrizController::class, 'aireautomotriz'])->name('jet-filter.catalogo.aireautomotriz')->middleware('auth');
Route::post('/jetfilter/catalogo/aireautomotriz/cargar', [AireAutomotrizController::class, 'cargar'])->name('jet-filter.catalogo.aireautomotriz.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/aireautomotriz/crear', [AireAutomotrizController::class, 'crear'])->name('jet-filter.catalogo.aireautomotriz.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/aireautomotriz/store', [AireAutomotrizController::class, 'store'])->name('jet-filter.catalogo.aireautomotriz.store')->middleware('auth');
Route::get('/jetfilter/catalogo/aireautomotriz/show/{id}', [AireAutomotrizController::class, 'show'])->name('jet-filter.catalogo.aireautomotriz.show')->middleware('auth');
Route::get('/jetfilter/catalogo/aireautomotriz/edit/{id}', [AireAutomotrizController::class, 'edit'])->name('jet-filter.catalogo.aireautomotriz.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/aireautomotriz/update/{filtro_automotriz}', [AireAutomotrizController::class, 'update'])->name('jet-filter.catalogo.aireautomotriz.update')->middleware('auth');
Route::get('/jetfilter/catalogo/aireautomotriz/edit_imagenes/{id}', [AireAutomotrizController::class, 'edit_imagenes'])->name('jet-filter.catalogo.aireautomotriz.edit_imagenes')->middleware('auth');
Route::post('/jetfilter/catalogo/aireautomotriz/delete/{id}', [AireAutomotrizController::class, 'delete'])->name('jet-filter.catalogo.aireautomotriz.delete')->middleware('auth');

Route::get('/jetfilter/catalogo/aireindustrial', [AireIndustrialController::class, 'aireindustrial'])->name('jet-filter.catalogo.aireindustrial')->middleware('auth');
Route::post('/jetfilter/catalogo/aireindustrial/cargar', [AireIndustrialController::class, 'cargar'])->name('jet-filter.catalogo.aireindustrial.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/aireindustrial/crear', [AireIndustrialController::class, 'crear'])->name('jet-filter.catalogo.aireindustrial.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/aireindustrial/store', [AireIndustrialController::class, 'store'])->name('jet-filter.catalogo.aireindustrial.store')->middleware('auth');
Route::get('/jetfilter/catalogo/aireindustrial/show/{id}', [AireIndustrialController::class, 'show'])->name('jet-filter.catalogo.aireindustrial.show')->middleware('auth');
Route::get('/jetfilter/catalogo/aireindustrial/edit/{id}', [AireIndustrialController::class, 'edit'])->name('jet-filter.catalogo.aireindustrial.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/aireindustrial/update/{filtro_industrial}', [AireIndustrialController::class, 'update'])->name('jet-filter.catalogo.aireindustrial.update')->middleware('auth');
Route::get('/jetfilter/catalogo/aireindustrial/edit_imagenes/{id}', [AireIndustrialController::class, 'edit_imagenes'])->name('jet-filter.catalogo.aireindustrial.edit_imagenes')->middleware('auth');
Route::post('/jetfilter/catalogo/aireindustrial/delete/{id}', [AireIndustrialController::class, 'delete'])->name('jet-filter.catalogo.aireindustrial.delete')->middleware('auth');

Route::get('/jetfilter/catalogo/combustiblelinea', [CombustibleLineaController::class, 'combustiblelinea'])->name('jet-filter.catalogo.combustiblelinea')->middleware('auth');
Route::post('/jetfilter/catalogo/combustiblelinea/cargar', [CombustibleLineaController::class, 'cargar'])->name('jet-filter.catalogo.combustiblelinea.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/combustiblelinea/crear', [CombustibleLineaController::class, 'crear'])->name('jet-filter.catalogo.combustiblelinea.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/combustiblelinea/store', [CombustibleLineaController::class, 'store'])->name('jet-filter.catalogo.combustiblelinea.store')->middleware('auth');
Route::get('/jetfilter/catalogo/combustiblelinea/show/{id}', [CombustibleLineaController::class, 'show'])->name('jet-filter.catalogo.combustiblelinea.show')->middleware('auth');
Route::get('/jetfilter/catalogo/combustiblelinea/edit/{id}', [CombustibleLineaController::class, 'edit'])->name('jet-filter.catalogo.combustiblelinea.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/combustiblelinea/update/{filtro_combustible}', [CombustibleLineaController::class, 'update'])->name('jet-filter.catalogo.combustiblelinea.update')->middleware('auth');
Route::get('/jetfilter/catalogo/combustiblelinea/edit_imagenes/{id}', [CombustibleLineaController::class, 'edit_imagenes'])->name('jet-filter.catalogo.combustiblelinea.edit_imagenes')->middleware('auth');
Route::post('/jetfilter/catalogo/combustiblelinea/delete/{id}', [CombustibleLineaController::class, 'delete'])->name('jet-filter.catalogo.combustiblelinea.delete')->middleware('auth');


Route::get('/jetfilter/catalogo/elemento', [ElementoController::class, 'elemento'])->name('jet-filter.catalogo.elemento')->middleware('auth');
Route::post('/jetfilter/catalogo/elemento/cargar', [ElementoController::class, 'cargar'])->name('jet-filter.catalogo.elemento.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/elemento/crear', [ElementoController::class, 'crear'])->name('jet-filter.catalogo.elemento.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/elemento/store', [ElementoController::class, 'store'])->name('jet-filter.catalogo.elemento.store')->middleware('auth');
Route::get('/jetfilter/catalogo/elemento/show/{id}', [ElementoController::class, 'show'])->name('jet-filter.catalogo.elemento.show')->middleware('auth');
Route::get('/jetfilter/catalogo/elemento/edit/{id}', [ElementoController::class, 'edit'])->name('jet-filter.catalogo.elemento.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/elemento/update/{filtro_elemento}', [ElementoController::class, 'update'])->name('jet-filter.catalogo.elemento.update')->middleware('auth');
Route::get('/jetfilter/catalogo/elemento/edit_imagenes/{id}', [ElementoController::class, 'edit_imagenes'])->name('jet-filter.catalogo.elemento.edit_imagenes')->middleware('auth');
Route::post('/jetfilter/catalogo/elemento/delete/{id}', [ElementoController::class, 'delete'])->name('jet-filter.catalogo.elemento.delete')->middleware('auth');

Route::get('/jetfilter/catalogo/panel', [PanelController::class, 'panel'])->name('jet-filter.catalogo.panel')->middleware('auth');
Route::post('/jetfilter/catalogo/panel/cargar', [PanelController::class, 'cargar'])->name('jet-filter.catalogo.panel.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/panel/crear', [PanelController::class, 'crear'])->name('jet-filter.catalogo.panel.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/panel/store', [PanelController::class, 'store'])->name('jet-filter.catalogo.panel.store')->middleware('auth');
Route::get('/jetfilter/catalogo/panel/show/{id}', [PanelController::class, 'show'])->name('jet-filter.catalogo.panel.show')->middleware('auth');
Route::get('/jetfilter/catalogo/panel/edit/{id}', [PanelController::class, 'edit'])->name('jet-filter.catalogo.panel.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/panel/update/{filtro_panel}', [PanelController::class, 'update'])->name('jet-filter.catalogo.panel.update')->middleware('auth');
Route::get('/jetfilter/catalogo/panel/edit_imagenes/{id}', [PanelController::class, 'edit_imagenes'])->name('jet-filter.catalogo.panel.edit_imagenes')->middleware('auth');
Route::post('/jetfilter/catalogo/panel/delete/{id}', [PanelController::class, 'delete'])->name('jet-filter.catalogo.panel.delete')->middleware('auth');

Route::get('/jetfilter/catalogo/sellado', [SelladoController::class, 'sellado'])->name('jet-filter.catalogo.sellado')->middleware('auth');
Route::post('/jetfilter/catalogo/sellado/cargar', [SelladoController::class, 'cargar'])->name('jet-filter.catalogo.sellado.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/sellado/crear', [SelladoController::class, 'crear'])->name('jet-filter.catalogo.sellado.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/sellado/store', [SelladoController::class, 'store'])->name('jet-filter.catalogo.sellado.store')->middleware('auth');
Route::get('/jetfilter/catalogo/sellado/show/{id}', [SelladoController::class, 'show'])->name('jet-filter.catalogo.sellado.show')->middleware('auth');
Route::get('/jetfilter/catalogo/sellado/edit/{id}', [SelladoController::class, 'edit'])->name('jet-filter.catalogo.sellado.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/sellado/update/{filtro_sellado}', [SelladoController::class, 'update'])->name('jet-filter.catalogo.sellado.update')->middleware('auth');
Route::get('/jetfilter/catalogo/sellado/edit_imagenes/{id}', [SelladoController::class, 'edit_imagenes'])->name('jet-filter.catalogo.sellado.edit_imagenes')->middleware('auth');
Route::post('/jetfilter/catalogo/sellado/delete/{id}', [SelladoController::class, 'delete'])->name('jet-filter.catalogo.sellado.delete')->middleware('auth');

Route::get('/jetfilter/catalogo/aplicacion_agricola', [AplicacionAgricola::class, 'aplicacion_agricola'])->name('jet-filter.catalogo.aplicacion_agricola')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_agricola/nuevo', [AplicacionAgricola::class, 'nuevo'])->name('jet-filter.catalogo.aplicacion_agricola.nuevo')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_agricola/store', [AplicacionAgricola::class, 'store'])->name('jet-filter.catalogo.aplicacion_agricola.store')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_agricola/show/{id}', [AplicacionAgricola::class, 'show'])->name('jet-filter.catalogo.aplicacion_agricola.show')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_agricola/edit/{id}', [AplicacionAgricola::class, 'edit'])->name('jet-filter.catalogo.aplicacion_agricola.edit')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_agricola/delete/{id}', [AplicacionAgricola::class, 'delete'])->name('jet-filter.catalogo.aplicacion_agricola.delete')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_agricola/delete/{id}', [AplicacionAgricola::class, 'delete'])->name('jet-filter.catalogo.aplicacion_agricola.delete')->middleware('auth');
Route::put('/jetfilter/catalogo/aplicacion_agricola/update/{id}', [AplicacionAgricola::class, 'update'])->name('jet-filter.catalogo.aplicacion_agricola.update')->middleware('auth');

Route::get('/jetfilter/catalogo/aplicacion_comercial', [AplicacionComercial::class, 'aplicacion_comercial'])->name('jet-filter.catalogo.aplicacion_comercial')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_comercial/nuevo', [AplicacionComercial::class, 'nuevo'])->name('jet-filter.catalogo.aplicacion_comercial.nuevo')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_comercial/store', [AplicacionComercial::class, 'store'])->name('jet-filter.catalogo.aplicacion_comercial.store')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_comercial/show/{id}', [AplicacionComercial::class, 'show'])->name('jet-filter.catalogo.aplicacion_comercial.show')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_comercial/edit/{id}', [AplicacionComercial::class, 'edit'])->name('jet-filter.catalogo.aplicacion_comercial.edit')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_comercial/delete/{id}', [AplicacionComercial::class, 'delete'])->name('jet-filter.catalogo.aplicacion_comercial.delete')->middleware('auth');
Route::put('/jetfilter/catalogo/aplicacion_comercial/update/{id}', [AplicacionComercial::class, 'update'])->name('jet-filter.catalogo.aplicacion_comercial.update')->middleware('auth');

Route::get('/jetfilter/catalogo/aplicacion_carretera', [AplicacionCarretera::class, 'aplicacion_carretera'])->name('jet-filter.catalogo.aplicacion_carretera')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_carretera/nuevo', [AplicacionCarretera::class, 'nuevo'])->name('jet-filter.catalogo.aplicacion_carretera.nuevo')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_carretera/store', [AplicacionCarretera::class, 'store'])->name('jet-filter.catalogo.aplicacion_carretera.store')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_carretera/show/{id}', [AplicacionCarretera::class, 'show'])->name('jet-filter.catalogo.aplicacion_carretera.show')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_carretera/edit/{id}', [AplicacionCarretera::class, 'edit'])->name('jet-filter.catalogo.aplicacion_carretera.edit')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_carretera/delete/{id}', [AplicacionCarretera::class, 'delete'])->name('jet-filter.catalogo.aplicacion_carretera.delete')->middleware('auth');
Route::put('/jetfilter/catalogo/aplicacion_carretera/update/{id}', [AplicacionCarretera::class, 'update'])->name('jet-filter.catalogo.aplicacion_carretera.update')->middleware('auth');

Route::get('/jetfilter/catalogo/aplicacion_liviano', [AplicacionLiviano::class, 'aplicacion_liviano'])->name('jet-filter.catalogo.aplicacion_liviano')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_liviano/nuevo', [AplicacionLiviano::class, 'nuevo'])->name('jet-filter.catalogo.aplicacion_liviano.nuevo')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_liviano/store', [AplicacionLiviano::class, 'store'])->name('jet-filter.catalogo.aplicacion_liviano.store')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_liviano/show/{id}', [AplicacionLiviano::class, 'show'])->name('jet-filter.catalogo.aplicacion_liviano.show')->middleware('auth');
Route::get('/jetfilter/catalogo/aplicacion_liviano/edit/{id}', [AplicacionLiviano::class, 'edit'])->name('jet-filter.catalogo.aplicacion_liviano.edit')->middleware('auth');
Route::post('/jetfilter/catalogo/aplicacion_liviano/delete/{id}', [AplicacionLiviano::class, 'delete'])->name('jet-filter.catalogo.aplicacion_liviano.delete')->middleware('auth');
Route::put('/jetfilter/catalogo/aplicacion_liviano/update/{id}', [AplicacionLiviano::class, 'update'])->name('jet-filter.catalogo.aplicacion_liviano.update')->middleware('auth');

Route::get('/jetfilter/catalogo/vehiculos', [VehiculosController::class, 'vehiculos'])->name('jet-filter.catalogo.vehiculos')->middleware('auth');
Route::post('/jetfilter/catalogo/vehiculos/cargar', [VehiculosController::class, 'cargar'])->name('jet-filter.catalogo.vehiculos.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/vehiculos/crear', [VehiculosController::class, 'crear'])->name('jet-filter.catalogo.vehiculos.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/vehiculos/store', [VehiculosController::class, 'store'])->name('jet-filter.catalogo.vehiculos.store')->middleware('auth');
Route::post('/jetfilter/catalogo/vehiculos/delete/{id}', [VehiculosController::class, 'delete'])->name('jet-filter.catalogo.vehiculos.delete')->middleware('auth');
Route::get('/jetfilter/catalogo/vehiculos/show/{id}', [VehiculosController::class, 'show'])->name('jet-filter.catalogo.vehiculos.show')->middleware('auth');
Route::get('/jetfilter/catalogo/vehiculos/edit/{id}', [VehiculosController::class, 'edit'])->name('jet-filter.catalogo.vehiculos.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/vehiculos/update/{id}', [VehiculosController::class, 'update'])->name('jet-filter.catalogo.vehiculos.update')->middleware('auth');


Route::get('/jetfilter/catalogo/marcas', [MarcasController::class, 'marcas'])->name('jet-filter.catalogo.marcas')->middleware('auth');
Route::post('/jetfilter/catalogo/marcas/cargar', [MarcasController::class, 'cargar'])->name('jet-filter.catalogo.marcas.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/crear', [MarcasController::class, 'crear'])->name('jet-filter.catalogo.marcas.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/marcas/store', [MarcasController::class, 'store'])->name('jet-filter.catalogo.marcas.store')->middleware('auth');
Route::post('/jetfilter/catalogo/marcas/delete/{id}', [MarcasController::class, 'delete'])->name('jet-filter.catalogo.marcas.delete')->middleware('auth');
Route::get('/jetfilter/catalogo/marcas/show/{id}', [MarcasController::class, 'show'])->name('jet-filter.catalogo.marcas.show')->middleware('auth');
Route::get('/jetfilter/catalogo/marcas/edit/{id}', [MarcasController::class, 'edit'])->name('jet-filter.catalogo.marcas.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/marcas/update/{id}', [MarcasController::class, 'update'])->name('jet-filter.catalogo.marcas.update')->middleware('auth');

Route::get('/jetfilter/catalogo/equivalencias', [EquivalenciaController::class, 'equivalencias'])->name('jet-filter.catalogo.equivalencias')->middleware('auth');
Route::post('/jetfilter/catalogo/equivalencias/cargar', [EquivalenciaController::class, 'cargar'])->name('jet-filter.catalogo.equivalencias.cargar')->middleware('auth');
Route::get('/jetfilter/catalogo/equivalencias/crear', [EquivalenciaController::class, 'crear'])->name('jet-filter.catalogo.equivalencias.crear')->middleware('auth');
Route::post('/jetfilter/catalogo/equivalencias/store', [EquivalenciaController::class, 'store'])->name('jet-filter.catalogo.equivalencias.store')->middleware('auth');
Route::post('/jetfilter/catalogo/equivalencias/delete/{id}', [EquivalenciaController::class, 'delete'])->name('jet-filter.catalogo.equivalencias.delete')->middleware('auth');
Route::get('/jetfilter/catalogo/equivalencias/show/{id}', [EquivalenciaController::class, 'show'])->name('jet-filter.catalogo.equivalencias.show')->middleware('auth');
Route::get('/jetfilter/catalogo/equivalencias/edit/{id}', [EquivalenciaController::class, 'edit'])->name('jet-filter.catalogo.equivalencias.edit')->middleware('auth');
Route::put('/jetfilter/catalogo/equivalencias/update/{id}', [EquivalenciaController::class, 'update'])->name('jet-filter.catalogo.equivalencias.update')->middleware('auth');

Route::get('/jetfilter/distribuidoras', [DistribuidorasController::class, 'distribuidoras'])->name('jet-filter.distribuidoras')->middleware('auth');
Route::get('/jetfilter/distribuidoras/venezuela', [DistribuidorasController::class, 'distribuidoras_venezuela'])->name('jet-filter.distribuidoras.venezuela')->middleware('auth');
Route::post('/jetfilter/distribuidoras/cargar', [DistribuidorasController::class, 'cargar'])->name('jet-filter.distribuidoras.cargar')->middleware('auth');
Route::view('/jetfilter/distribuidoras/venezuela/nuevo', 'jetfilter.distribuidoras.venezuela.nuevo' )->name('jet-filter.distribuidoras.venezuela.nuevo')->middleware('auth');
Route::post('/jetfilter/distribuidoras/store', [DistribuidorasController::class, 'store'])->name('jet-filter.distribuidoras.store')->middleware('auth');
Route::post('/jetfilter/distribuidoras/delete/{id}', [DistribuidorasController::class, 'delete'])->name('jet-filter.distribuidoras.venezuela.delete')->middleware('auth');
Route::get('/jetfilter/distribuidoras/venezuela/edit/{id}', [DistribuidorasController::class, 'edit'])->name('jet-filter.distribuidoras.venezuela.edit')->middleware('auth');
Route::post('/jetfilter/distribuidoras/update/{id}', [DistribuidorasController::class, 'update'])->name('jet-filter.distribuidoras.update')->middleware('auth');

Route::view('/jetfilter/distribuidoras/ecuador', 'jetfilter.distribuidoras.ecuador.index')->name('jet-filter.distribuidoras.ecuador')->middleware('auth');
Route::view('/jetfilter/distribuidoras/ecuador/nuevo', 'jetfilter.distribuidoras.ecuador.nuevo' )->name('jet-filter.distribuidoras.ecuador.nuevo')->middleware('auth');
Route::get('/jetfilter/distribuidoras/ecuador/edit/{id}', [DistribuidorasController::class, 'edit_ecuador'])->name('jet-filter.distribuidoras.ecuador.edit')->middleware('auth');

Route::view('/jetfilter/distribuidoras/dominicana', 'jetfilter.distribuidoras.dominicana.index' )->name('jet-filter.distribuidoras.dominicana')->middleware('auth');
Route::view('/jetfilter/distribuidoras/dominicana/nuevo', 'jetfilter.distribuidoras.dominicana.nuevo' )->name('jet-filter.distribuidoras.dominicana.nuevo')->middleware('auth');
Route::get('/jetfilter/distribuidoras/dominicana/edit/{id}', [DistribuidorasController::class, 'edit_dominicana'])->name('jet-filter.distribuidoras.dominicana.edit')->middleware('auth');

Route::post('/jetfilter/generarpdf/vehiculos_agricolas', [PDFController::class, 'generarVehiculosAgricolas'])->name('jet-filter.generarpdf.vehiculos_agricolas')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_livianos', [PDFController::class, 'generarVehiculosLivianos'])->name('jet-filter.generarpdf.vehiculos_livianos')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_comerciales', [PDFController::class, 'generarVehiculosComerciales'])->name('jet-filter.generarpdf.vehiculos_comerciales')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_comerciales1', [PDFController::class, 'generarVehiculosComerciales1'])->name('jet-filter.generarpdf.vehiculos_comerciales1')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_comerciales2', [PDFController::class, 'generarVehiculosComerciales2'])->name('jet-filter.generarpdf.vehiculos_comerciales2')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_comerciales3', [PDFController::class, 'generarVehiculosComerciales3'])->name('jet-filter.generarpdf.vehiculos_comerciales3')->middleware('auth');

Route::post('/jetfilter/generarpdf/vehiculos_carretera', [PDFController::class, 'generarVehiculosCarretera'])->name('jet-filter.generarpdf.vehiculos_carretera')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_carretera1', [PDFController::class, 'generarVehiculosCarretera1'])->name('jet-filter.generarpdf.vehiculos_carretera1')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_carretera2', [PDFController::class, 'generarVehiculosCarretera2'])->name('jet-filter.generarpdf.vehiculos_carretera2')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_carretera3', [PDFController::class, 'generarVehiculosCarretera3'])->name('jet-filter.generarpdf.vehiculos_carretera3')->middleware('auth');
Route::post('/jetfilter/generarpdf/vehiculos_carretera4', [PDFController::class, 'generarVehiculosCarretera4'])->name('jet-filter.generarpdf.vehiculos_carretera4')->middleware('auth');

Route::post('/jetfilter/generarpdf/especificaciones', [PDFController::class, 'generarEspecificaciones'])->name('jet-filter.generarpdf.especificaciones')->middleware('auth');
Route::post('/jetfilter/generarpdf/equivalencias', [PDFController::class, 'generarEquivalencias'])->name('jet-filter.generarpdf.equivalencias')->middleware('auth');
Route::post('/jetfilter/generarpdf/catalogo_completo', [PDFController::class, 'generarCatalogoCompleto'])->name('jet-filter.generarpdf.catalogo_completo')->middleware('auth');


Route::get('/jetfilter/logout', [LogoutController::class, 'logout'])->name('jet-filter.logout')->middleware('auth');

Route::get('/jetfilter/marketing', [MarketingController::class, 'index'])->name('jet-filter.marketing.index')->middleware('auth');
Route::get('/jetfilter/marketing/presupuesto', [MarketingController::class, 'presupuesto'])->name('jet-filter.marketing.presupuesto')->middleware('auth');
Route::get('/jetfilter/marketing/proyeccion', [MarketingController::class, 'proyeccion'])->name('jet-filter.marketing.proyeccion')->middleware('auth');

Route::get('/jetfilter/marketing/estrategias', [EstrategiasController::class, 'index'])->name('jet-filter.marketing.estrategias')->middleware('auth');
Route::get('/jetfilter/marketing/estrategias/nuevo', [EstrategiasController::class, 'nuevo'])->name('jet-filter.marketing.estrategias.nuevo')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/store', [EstrategiasController::class, 'store'])->name('jet-filter.marketing.estrategias.store')->middleware('auth');
Route::get('/jetfilter/marketing/estrategias/edit/{estrategia}', [EstrategiasController::class, 'edit'])->name('jet-filter.marketing.estrategias.edit')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/edit/{estrategia}', [EstrategiasController::class, 'edit_info'])->name('jet-filter.marketing.estrategias.edit_info')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/update/{id}', [EstrategiasController::class, 'update'])->name('jet-filter.marketing.estrategias.update')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/datos', [EstrategiasController::class, 'datos'])->name('jet-filter.marketing.estrategias.datos')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/objetivos/{id}', [EstrategiasController::class, 'objetivos'])->name('jet-filter.marketing.estrategias.objetivos')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/recursos/{id}', [EstrategiasController::class, 'recursos'])->name('jet-filter.marketing.estrategias.recursos')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/fases/{id}', [EstrategiasController::class, 'fases'])->name('jet-filter.marketing.estrategias.fases')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/recursos_edit/{id}', [EstrategiasController::class, 'recursos_edit'])->name('jet-filter.marketing.estrategias.recursos_edit')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/buyer_persona/{id}', [EstrategiasController::class, 'buyer_persona'])->name('jet-filter.marketing.estrategias.buyer_persona')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/responsables/{id}', [EstrategiasController::class, 'responsables'])->name('jet-filter.marketing.estrategias.responsables')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/kpi/{id}', [EstrategiasController::class, 'kpi'])->name('jet-filter.marketing.estrategias.kpi')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/{id}/kpi/store', [EstrategiasController::class, 'kpi_store'])->name('jet-filter.marketing.estrategias.kpi_store')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/analisis/{id}', [EstrategiasController::class, 'analisis'])->name('jet-filter.marketing.estrategias.analisis')->middleware('auth');
Route::post('/jetfilter/marketing/estrategias/{id}/analisis/store', [EstrategiasController::class, 'analisis_store'])->name('jet-filter.marketing.estrategias.analisis_store')->middleware('auth');


Route::get('/jetfilter/marketing/prueba', [MarketingController::class, 'prueba'])->name('jet-filter.marketing.prueba')->middleware('auth');

Route::post('/jetfilter/marketing/graficas', [GraficaController::class, 'graficas'])->name('jet-filter.marketing.graficas')->middleware('auth');

Route::post('/jetfilter/marketing/presupuesto', [PresupuestoController::class, 'presupuesto_cantidades'])->name('jet-filter.marketing.presupuesto_cantidades')->middleware('auth');
Route::get('/jetfilter/marketing/presupuesto/edit/{id}', [PresupuestoController::class, 'edit'])->name('jet-filter.marketing.presupuesto.edit')->middleware('auth');
Route::post('/jetfilter/marketing/presupuesto/edit/{estrategia}', [PresupuestoController::class, 'edit_datos'])->name('jet-filter.marketing.presupuesto.edit_datos')->middleware('auth');
Route::post('/jetfilter/marketing/actividades/tarea/{id}', [PresupuestoController::class, 'actividades'])->name('jet-filter.marketing.actividades')->middleware('auth');
Route::post('/jetfilter/marketing/actividades/store', [PresupuestoController::class, 'store'])->name('jet-filter.marketing.actividades.store')->middleware('auth');
Route::post('/jetfilter/marketing/actividades/delete/{id_estrategia}/{id_tarea}', [PresupuestoController::class, 'delete'])->name('jet-filter.marketing.actividades.delete')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
