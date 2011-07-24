<html>
    <head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    {if isset($onready) && $onready}
        <script type="text/javascript" src="generated.js"></script>
    {/if}
    <title>onready test</title>
</head>
<body>
    {include file="more/block.tpl"}
    
    <h1 id="indexh1" style="display:none">I'm inside index.tpl</h1>
    {onready ns='main'}$("#indexh1").show(){/onready}


<script type="text/javascript">/* <![CDATA[ */
jQuery().ready(function() {ldelim}
    {if isset($onready) && $onready}
        {readyon mode="call"}
    {else}
        {readyon mode="embed"}
    {/if}
{rdelim});
/* ]]> */</script>

</body>
</html>

