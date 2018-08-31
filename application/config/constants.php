<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Diretórios do sistema
|--------------------------------------------------------------------------
| 
| Locais dos diretórios para o uso de imagens, estilos e scripts
|
*/

define('URL', 'http://localhost/base_conhecimento/');
define('IMG', URL.'img/');
define('CSS', URL.'css/');
define('JS', URL.'js/');
define('URLUPLOAD', APPPATH."uploads/");


/*
|--------------------------------------------------------------------------
| Tipos de conteúdo
|--------------------------------------------------------------------------
| 
| Tipos possíveis para os conteúdos
|
*/

define('CTIPO_ARTIGO', 1);
define('CTIPO_VIDEO', 2);
define('CTIPO_IMAGEM', 3);
define('CTIPO_AUDIO', 4);
define('CTIPO_LIVRO', 5);
define('CTIPO_PERGUNTA', 6);
define('CTIPO_LINK', 7);
define('CTIPO_OUTRO', 8);
define('CTIPO_BASE', 9);

/*
|--------------------------------------------------------------------------
| Grupos Padrão
|--------------------------------------------------------------------------
| 
| Grupos pré-definidos no sistema
|
*/

define('GP_ADMINISTRADOR', 1);
define('GP_PROPRIETARIO', 2);
define('GP_COLABORADOR', 3);
define('GP_MEMBRO', 4);

/* End of file constants.php */
/* Location: ./application/config/constants.php */

/*
|--------------------------------------------------------------------------
| Situação dos Conteudos
|--------------------------------------------------------------------------
| 
| Números correspondentes a situação que o conteúdo se encontra
|
*/

define('CT_ST_APROVADO', 3);
define('CT_ST_REVISANDO', 2);
define('CT_ST_PENDENTE', 1);
define('CT_ST_RECUSADO', 0);

/* End of file constants.php */
/* Location: ./application/config/constants.php */

/*
|--------------------------------------------------------------------------
| Situação dos Usuários
|--------------------------------------------------------------------------
| 
| Números correspondentes a situação que o usuário se encontra
|
*/

define('USUARIO_AGUARDANDO', 0);
define('USUARIO_APROVADO', 1);
define('USUARIO_BLOQUEADO', 2);

/* End of file constants.php */
/* Location: ./application/config/constants.php */