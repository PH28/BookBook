<ul class="wn__pagination" style="margin-top: 20px !important;">
    @if ($paginator->currentPage() != $paginator->firstItem() && $paginator->total() != 0)
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="zmdi zmdi-chevron-left"></i></a></li>
    @endif

    @if ($paginator->lastPage() >= 5)

        @if ($paginator->currentPage() >= 1 && $paginator->currentPage() <= 4)

            @for ($page = 1; $page <= 5; $page++)
                @if ($paginator->currentPage() == $page)
                    <li class="active"><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @else
                    <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endfor

        @elseif ($paginator->currentPage() >= $paginator->lastPage() - 3 && $paginator->currentPage() <= $paginator->lastPage())

            @for ($page = $paginator->lastPage() - 4; $page <= $paginator->lastPage(); $page++)
                @if ($paginator->currentPage() == $page)
                    <li class="active"><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @else
                    <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endfor

        @else

            @for ($page = $paginator->currentPage() - 2; $page <= $paginator->currentPage() + 2; $page++)
                @if ($paginator->currentPage() == $page)
                    <li class="active"><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @else
                    <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endfor

        @endif

    @elseif ($paginator->lastPage() > 1 && $paginator->lastPage() <= 4)

        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            @if ($paginator->currentPage() == $page)
                <li class="active"><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
            @else
                <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
            @endif
        @endfor

    @endif

    @if ($paginator->currentPage() != $paginator->lastPage())
        <li><a href="{{ $paginator->nextPageUrl() }}"><i class="zmdi zmdi-chevron-right"></i></a></li>
    @endif
</ul>
