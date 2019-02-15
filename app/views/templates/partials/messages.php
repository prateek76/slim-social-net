{% if flash.global %}
		<div style="z-index: 1000000;
				    position: absolute;
				    background-color: #fafafaba;
				    width: 50%;
				    height: 6%;
				    left: 24%;
				    line-height: 36px;
				    text-align: -webkit-center;
				    color: #2a2424;
				    box-shadow: 0 0 20px black;" class="global">
			{{ flash.global }}
		</div>
{% endif %}
<?php
//if else statement in twig is above
?>