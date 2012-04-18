<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:a="urn:oasis:names:tc:opendocument:xmlns:container">

	<xsl:strip-space elements="*"/>
	<xsl:output method="text" indent="yes" encoding="UTF-8" />
	<xsl:template match="@*|*">
		<xsl:value-of select="/a:container/a:rootfiles/a:rootfile/@full-path" />
	</xsl:template>

</xsl:stylesheet>


