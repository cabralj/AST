<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:xhtml="http://www.w3.org/1999/xhtml"
	xmlns="http://www.w3.org/1999/xhtml"
	exclude-result-prefixes="xhtml">
	<xsl:output method="html" encoding="ISO-8859-1" indent="no"/>
    <xsl:template match="/">
		<xsl:copy-of select="//xhtml:p"/>
    </xsl:template>
</xsl:stylesheet>
