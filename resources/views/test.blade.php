
<p>{{$spaces . $tree->getValue()}}</p>
@if($tree->getLeft() != null)
    @include('test', ['spaces' => $spaces . '_____', 'tree' => $tree->getLeft()])
@endif
@if($tree->getRigth() != null)
    @include('test', ['spaces' => $spaces . '_____', 'tree' => $tree->getRigth()])
@endif
