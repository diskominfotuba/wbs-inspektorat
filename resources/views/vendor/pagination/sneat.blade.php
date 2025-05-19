@if ($paginator->hasPages())
<div class="demo-inline-spacing mt-3">
<nav aria-label="Page navigation">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
        <li class="page-item first">
            <a class="page-link" href="javascript:void(0);"
            ><i class="tf-icon bx bx-chevrons-left"></i
          ></a>
        </li>
        @else
        <li class="page-item prev">
            <a onclick="loadPaginate({{ explode('page=', $paginator->previousPageUrl())[1]}})" class="page-link" href="javascript:void(0);" tabindex="-1">
                <i class="tf-icon bx bx-chevron-left"></i>
            </a>
        </li>
        @endif
    
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item"><a class="page-link" href="#">{{ $element }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" href="#">{{ $page }}</a>
                        </li>
                    @else
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadPaginate({{ explode('page=', $url)[1]}})">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <li class="page-item next">
                <a class="page-link" onclick="loadPaginate({{ explode('page=',$paginator->nextPageUrl())[1]}})" href="javascript:void(0);">
                    <i class="tf-icon bx bx-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item last">
                <a class="page-link" href="#"><i class="tf-icon bx bx-chevrons-right"></i></a>
            </li>
        @endif
    </ul>
</nav>
</div>
@endif