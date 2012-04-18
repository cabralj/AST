<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:x="http://www.w3.org/1999/xhtml"
	>
	<xsl:strip-space elements="*"/>
	<xsl:output method="html" indent="yes" encoding="ISO-8859-15" />
	<xsl:template match="@*|*">
		<div id="{$ref}" class="ast_book_part">
		<xsl:copy-of select="/x:html/x:body/node()" />
		</div>
	</xsl:template>
</xsl:stylesheet>
