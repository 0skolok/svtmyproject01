<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

IncludeModuleLangFile(__FILE__);

class soprunov_education extends CModule
{
	/**
	 * Returns module name
	 *
	 * @return string
	 */
	public static function getModuleId()
	{
		return basename(dirname(__DIR__));
	}

	public function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__) . "/version.php");
		$this->MODULE_ID = self::getModuleId();
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage(self::getModuleId() . ".MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage(self::getModuleId() . ".MODULE_DESC");

		$this->PARTNER_NAME = GetMessage(self::getModuleId() . ".PARTNER_NAME");
		$this->PARTNER_URI = GetMessage(self::getModuleId() . ".PARTNER_URI");
	}

	public function DoInstall()
	{
		$this->InstallDB();
		$this->InstallFiles();
		$this->InstallEvents();
		RegisterModule(self::getModuleId());
	}

	public function DoUninstall()
	{
		UnRegisterModule(self::getModuleId());
		$this->UnInstallEvents();
		$this->UnInstallFiles();
		$this->UnInstallDB();
	}

	public function InstallDB()
	{
		if (is_dir($d = dirname(__FILE__) . "/db/"))
		{
			global $DB;
			$DB->RunSQLBatch($d . strtolower($DB->type) . "/install.sql");
		}

		return TRUE;
	}

	public function UnInstallDB($arParams = array())
	{
		if (is_dir($d = dirname(__FILE__) . "/db/"))
		{
			global $DB;
			$DB->RunSQLBatch($d . strtolower($DB->type) . "/uninstall.sql");
		}

		return TRUE;
	}

	public function InstallFiles($arParams = array())
	{
		// Create admin page include files
		if (is_dir($sAdminPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/'.self::getModuleId().'/admin'))
		{
			if ($dir = opendir($sAdminPath))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
					{
						continue;
					}
					$sFileContent = '<?require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/'.self::getModuleId().'/admin/' . $item . '";?>';
					file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/'.self::getModuleId().'_' . $item, $sFileContent);
				}
				closedir($dir);
			}
		}

		CopyDirFiles(__DIR__."/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/", TRUE, TRUE);

		return TRUE;
	}

	public function UnInstallFiles()
	{
		// Remove admin page include files
		if (is_dir($sAdminPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/'.self::getModuleId().'/admin'))
		{
			if ($dir = opendir($sAdminPath))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
					{
						continue;
					}
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::getModuleId().'_'.$item);
				}
				closedir($dir);
			}
		}

		return TRUE;
	}

	public function InstallEvents()
	{
		return TRUE;
	}

	public function UnInstallEvents()
	{
		return TRUE;
	}
}
?>
