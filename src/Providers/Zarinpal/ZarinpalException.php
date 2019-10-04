<?php

namespace Dena\IranPayment\Providers\Zarinpal;

use Exception;

class ZarinpalException extends Exception
{
	protected $error_id;
	
	public static $errors = [
		-1	=> 'اطلاعات ارسال شده ناقص است.',
		-2	=> 'IP و یا مرچنت کد پذیرنده صحیح نیست',
		-3	=> 'رقم باید بالای 100 تومان باشد',
		-4	=> 'سطح پذیرنده پایین تر از سطح نقره ای است',
		-11	=> 'درخواست مورد نظر یافت نشد',
		-21	=> 'هیچ نوع عملیات مالی برای این تراکنش یافت نشد',
		-22	=> 'تراکنش ناموفق میباشد',
		-33	=> 'رقم تراکنش با رقم پرداخت شده مطابقت ندارد',
		-54	=> 'درخواست مورد نظر آرشیو شده',
		-99	=> 'خطای داخلی از سمت زرین پال',
		100	=> 'عملیات با موفقیت انجام شد',
		101	=> 'عملیات پرداخت با موفقیت انجام شده ولی قبلا عملیات PaymentVertification بر روی این تراکنش انجام شده است',
	];

	public function __construct($error_id)
	{
		$this->error_id = intval($error_id);

		parent::__construct(@self::$errors[$this->error_id].' #'.$this->error_id, $this->error_id);
	}
}
