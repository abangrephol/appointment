<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

    protected $layout = 'default';
    protected $themes = 'default';
    protected $viewBase = '';
    protected $currentUser;

    /**
     * Theme instance.
     *
     * @var \Teepluss\Theme\Theme
     */
    protected $theme;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        // Using theme as a global.
        $this->theme = Theme::uses('default')->layout('default');
    }
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			//$this->layout = View::make($this->layout);
            $this->theme = Theme::uses($this->themes)->layout($this->layout);

		}
	}



}
