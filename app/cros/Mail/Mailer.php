<?php
/**
* Mailer
*/
namespace cros\Mail;

class Mailer
{
	protected $view;

	protected $mailer;

	public function __construct($view, $mailer)
	{
		$this->view = $view;
		$this->mailer = $mailer;
	}

	public function send($template, $data, $callback)
	{
		$message = new Message($this->mailer);

		### now append the data to the view which are passed now ###
		$this->view->appendData($data);

		$message->body($this->view->render($template));

		call_user_func($callback, $message);

		$this->mailer->send();
	}	
}