<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Aunt::index');
$routes->post('/doLogin', 'Aunt::loginCheck');
$routes->get('/doLogout', 'Aunt::doLogout');

$routes->get('/administrator', 'Administrator::index');
$routes->get('/administrator/dashboard-it', 'Administrator::showDashboardIT');

$routes->get('/administrator/dashboard-uks', 'Administrator::showDashboardUKS');
$routes->get('/administrator/data-rekam-medis', 'Administrator::showDataRekamMedis');
$routes->get('/administrator/data-stok-obat', 'Administrator::showDataStokObat');

$routes->get('/administrator/dashboard-academic', 'Administrator::showDashboardAcademic');
$routes->get('/administrator/data-sekolah', 'Administrator::showDataSekolah');
$routes->get('/administrator/data-rombel', 'Administrator::showDataRombel');
$routes->get('/administrator/data-pesdik', 'Administrator::showDataPesdik');
$routes->get('/administrator/data-pesdik/(:num)', 'Administrator::showProfilPesdik/$1');
$routes->get('/administrator/data-mapel', 'Administrator::showDataMapel');
$routes->get('/administrator/data-eskul', 'Administrator::showDataEskul');
$routes->get('/administrator/data-guru-mapel', 'Administrator::showDataGuru');
$routes->get('/administrator/data-wali-kelas', 'Administrator::showDataWaliKls');
$routes->get('/administrator/data-thn-akademik', 'Administrator::showDataThnAkademik');

$routes->get('/administrator/standard-kkm', 'Administrator::showDataKkm');
$routes->get('/administrator/standard-afektif', 'Administrator::showDataAfektif');
$routes->get('/administrator/standard-eskul', 'Administrator::showDataStdEskul');
$routes->get('/administrator/standard-pengetahuan', 'Administrator::showDataStdPengetahuan');
$routes->get('/administrator/standard-keterampilan', 'Administrator::showDataStdKeterampilan');

$routes->get('/administrator/data-nilai-mapel', 'Administrator::showDataNilaiMapel');
$routes->get('/administrator/data-nilai-afektif', 'Administrator::showDataNilaiAfektif');
$routes->get('/administrator/data-nilai-eskul', 'Administrator::showDataNilaiEskul');
$routes->get('/administrator/data-absensi', 'Administrator::showDataAbsensi');

$routes->get('/administrator/data-ledger-bulanan', 'Administrator::showDataLedgerBulanan');
$routes->get('/administrator/data-ledger-semester', 'Administrator::showDataLedger');
$routes->get('/administrator/data-rapor-bulanan', 'Administrator::showDataRaporBulanan');
$routes->get('/administrator/data-rapor-semester', 'Administrator::showDataRaporSemester');
$routes->get('/administrator/data-nilai-bulanan', 'Administrator::showDataNilaiBulanan');

$routes->get('/administrator/rapor-nilai-bulanan', 'Administrator::showPrintRaporBulanan');
$routes->get('/monthly-report', 'Administrator::showPrintRaporBulanan');

$routes->get('/administrator/rapor-nilai-afektif', 'Administrator::showPrintRaporAfektif');
$routes->get('/administrator/rapor-nilai-pengetahuan', 'Administrator::showPrintRaporPengetahuan');
$routes->get('/administrator/rapor-nilai-keterampilan', 'Administrator::showPrintRaporKeterampilan');
$routes->get('/administrator/rapor-nilai-eskul', 'Administrator::showPrintRaporEskul');
$routes->get('/administrator/rapor-semester', 'Administrator::showPrintRaporSemester');
$routes->get('/semester-report', 'Administrator::showPrintRaporSemester');

$routes->get('/home', 'Home::index');
$routes->get('/health-report', 'Home::uks');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
