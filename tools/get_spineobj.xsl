<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:a="http://www.idpf.org/2007/opf"
	xmlns:dc="http://purl.org/dc/elements/1.1/" 
	xmlns:dcterms="http://purl.org/dc/terms/" 
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
	xmlns:opf="http://www.idpf.org/2007/opf"
	>
	<xsl:strip-space elements="*"/>
	<xsl:output method="text" indent="no" encoding="UTF-8" />
	<xsl:template match="@*|*">
		<xsl:for-each select="/a:package/a:spine/a:itemref">
			<xsl:variable name="key" select="@idref"/><xsl:value-of select="/a:package/a:manifest/a:item[@id=$key|@media-type='application/xhtml+xml']/@href" />,</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>
