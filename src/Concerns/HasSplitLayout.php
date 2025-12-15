<?php

namespace Ngankt2\AuthUi\Concerns;

trait HasSplitLayout
{
    public function getLayout(): string
    {
        return 'ngankt2-auth-ui::split-layout';
    }
}
