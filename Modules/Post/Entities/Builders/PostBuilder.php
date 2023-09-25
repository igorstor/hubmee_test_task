<?php

namespace Modules\Post\Entities\Builders;

use Illuminate\Database\Eloquent\Builder;

class PostBuilder extends Builder
{
    public function search(?string $search = null): self
    {
        return $this->when($search, function (self $builder) use ($search) {
            return $builder->whereTitleLike($search);
        });
    }

    public function whereTitleLike(string $search): self
    {
        return $this->where('title', 'LIKE', "%$search%");
    }
}
