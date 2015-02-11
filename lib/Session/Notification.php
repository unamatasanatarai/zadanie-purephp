<?php
namespace Session;

/**
 * Notifications
 */

use Session\Session;

class Notification
{
	const KEY = '_flash';

	/**
	 * Dodaj komunikat do wyświetlenia
	 *
	 * Pobiera dane z $_SESSION przetwarza i znowu ustawia. Jest tak, ponieważ
	 * nie należy pracować na zagnieżdżeniach bezpośrednio w sesji
	 *
	 * @param string $msg Komunikat
	 * @param string $type error|info|notice domyślnie info
	 * @param string $context zmienna, bo czasami mamy 5 stron otwartych i każda daje notification
	 *                        tą zmienną ograniczamy wyświetlanie tylko do właściwych.
	 */
	public static function add($msg, $type = 'info', $context = 'default')
	{
		if (empty($msg))
		{
			return;
		}

		if (! ($flash = Session::get(static::KEY . '.' . $context . '.' . $type)))
		{
			$flash = array();
		}

		$flash[] = $msg;

		Session::insert(static::KEY . '.' . $context . '.' . $type, $flash);
	}

	public static function get($context = 'default')
	{
		return empty($context)
			? Session::get(static::KEY)
			: Session::get(static::KEY . '.' . $context);
	}

	public static function remove($context = 'default')
	{
		Session::remove(static::KEY . '.' . $context);
	}

	/**
	 * Wyświetl komunikaty
	 */
	public static function fetch($context = 'default', $class_prefix = 'alert')
	{
		$html = '';

		if ( ! ($flash = self::get($context)))
		{
			return '';
		}

		foreach($flash as $type => $messages)
		{
			if ( ! empty($messages))
			{
				$html .= '<div class="' . $class_prefix . ' ' . $class_prefix . '-' . $type . '">';
				$html .= join('<br>', $messages);
				$html .= '</div>';
			}
		}

		self::remove($context);

		return $html;
	}
}