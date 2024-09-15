@if($paginator->total()>0)
<div class="dt--bottom-section d-sm-flex justify-content-sm-between text-center">
    <div class="dt--pages-count mb-sm-0 mb-3">
        <div class="dataTables_info" role="status" aria-live="polite">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} entries
        </div>
    </div>
    <div class="paginating-container pagination-default">
        <ul class="pagination">
            @if ($paginator->hasPages())
            <li class="prev" {{ $paginator->onFirstPage() ? 'disabled' : '' }}><a href="{{ $paginator->previousPageUrl() }}">Prev</a></li>
            <li><a href="javascript:void(0);">1</a></li>
            <li class="active"><a href="javascript:void(0);">2</a></li>
            <li><a href="javascript:void(0);">3</a></li>
            <li class="next" {{ $paginator->hasMorePages() ? '' : 'disabled' }}><a href="{{ $paginator->nextPageUrl() }}" >Next</a></li>
            @endif
        </ul>
    </div>
</div>
@endif