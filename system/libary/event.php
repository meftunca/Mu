<?php

namespace system\libary;


class event
{

	/**
	 * Trigger an event
	 *
	 * @param string $event
	 * @param string $method
	 * @param array $params
	 * @return void
	 */
	public function trigger($event, $method = 'handle', $params = [])
	{
		$listeners 	= import::get('app', 'listener');

		foreach ($listeners[$event] as $listener) {

			if (!class_exists($listener))
				throw new ExceptionHandler('Listener sınıfı bulunamadı.', $listener);

			if (!method_exists($listener, $method))
				throw new ExceptionHandler('Listener sınıfına ait method bulunamadı.', $listener . '::' . $method . '()');
				
			call_user_func_array(array(new $listener, $method), $params);
			
		}
	}

}