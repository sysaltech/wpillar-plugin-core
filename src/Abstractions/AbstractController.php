<?php

declare(strict_types=1);

namespace Plugin\Core\Abstractions;

abstract class AbstractController
{
    /**
     * The renderer passed to the controller in the provider.
     *
     * @var AbstractRenderer
     */
    protected $renderer;

    /**
     * The directory where the class is. Apply to its child.
     *
     * @var string
     */
    protected $dirName;

    /**
     * Controller constructor.
     * The best way to change the Renderer for a controller is by
     * making a child of this class and giving it a Rendered that is a
     * child of the Abstract_Renderer.
     *
     * @param AbstractRenderer $renderer
     */
    public function __construct(AbstractRenderer $renderer)
    {

        $this->renderer = $renderer;
        $this->dirName = $this->dirName();
    }

    /**
     * Inside function that returns the name of the class controller.
     *
     * @return mixed|string
     */
    protected function dirName()
    {

        $path = explode('\\', get_class($this));
        array_pop($path);
        return array_pop($path);
    }

    /**
     * default:
     * [
     *    'content' => []
     * ]
     *
     * @param array $args
     */
    public function args(array $args = [])
    {
        $context = [
            'context' => array_merge(
                [
                    'content' => '',
                ],
                $args
            ),
        ];
        $this->renderer->args($context);
    }

    protected function subDirectory()
    {

        $this->renderer->subDirectory('Services/' . $this->dirName . '/Views');
    }

    /**
     * Call $this->renderer->render() for views inside the Controller folder.
     *
     * @param string $view Use this parameter to render a view different than index.
     *
     * @return string
     */
    public function render(string $view = 'Index'): string
    {

        $this->args();
        $this->subDirectory();
        return $this->renderer->render($view);
    }

    /**
     * Call $this->renderer->shared() for views inside the Shared folder.
     *
     * @param string $view Use this parameter to render a view different than index.
     *
     * @return string
     */
    public function shared(string $view = 'Index'): string
    {

        $this->args();
        $this->renderer->sharedDir('Shared_Views');
        return $this->renderer->shared($view);
    }
}