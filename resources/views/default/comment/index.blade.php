
<?php
$commentPlugin = $systemPresenter->getKeyValue('comment_plugin');
$shortName = $systemPresenter->getKeyValue($commentPlugin.'_short_name');
?>
@include('default.comment.changyan')
{{--
@if($commentPlugin !='' && $shortName != '')
    @if($commentPlugin == 'duoshuo')
        @include('default.comment.duoshuo')
    @elseif($commentPlugin == 'disqus')
        @include('default.comment.disqus')
    @endif
@endif--}}
