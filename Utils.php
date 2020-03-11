<?php

function getTimestamp()
{
    list($seconds_fractional, $seconds_integral) = explode(" ", microtime());
    $milli_seconds = (int) $seconds_integral . substr($seconds_fractional, 2, 3);
    return (int) $milli_seconds;
}

function sendData($data)
{
    header("Content-Type: application/json");
    echo json_encode($data);
}

//extract from https://www.sitepoint.com/mime-types-complete-list/
function getContentTypeFromFileType($fileType)
{
    switch ($fileType) {
        case "x3d":
            return "application/vnd.hzn-3d-crossword";
            break;
        case "3gp":
            return "video/3gpp";
            break;
        case "3g2":
            return "video/3gpp2";
            break;
        case "mseq":
            return "application/vnd.mseq";
            break;
        case "pwn":
            return "application/vnd.3m.post-it-notes";
            break;
        case "plb":
            return "application/vnd.3gpp.pic-bw-large";
            break;
        case "psb":
            return "application/vnd.3gpp.pic-bw-small";
            break;
        case "pvb":
            return "application/vnd.3gpp.pic-bw-var";
            break;
        case "tcap":
            return "application/vnd.3gpp2.tcap";
            break;
        case "7z":
            return "application/x-7z-compressed";
            break;
        case "abw":
            return "application/x-abiword";
            break;
        case "ace":
            return "application/x-ace-compressed";
            break;
        case "acc":
            return "application/vnd.americandynamics.acc";
            break;
        case "acu":
            return "application/vnd.acucobol";
            break;
        case "atc":
            return "application/vnd.acucorp";
            break;
        case "adp":
            return "audio/adpcm";
            break;
        case "aab":
            return "application/x-authorware-bin";
            break;
        case "aam":
            return "application/x-authorware-map";
            break;
        case "aas":
            return "application/x-authorware-seg";
            break;
        case "air":
            return "application/vnd.adobe.air-application-installer-package+zip";
            break;
        case "swf":
            return "application/x-shockwave-flash";
            break;
        case "fxp":
            return "application/vnd.adobe.fxp";
            break;
        case "pdf":
            return "application/pdf";
            break;
        case "ppd":
            return "application/vnd.cups-ppd";
            break;
        case "dir":
            return "application/x-director";
            break;
        case "xdp":
            return "application/vnd.adobe.xdp+xml";
            break;
        case "xfdf":
            return "application/vnd.adobe.xfdf";
            break;
        case "aac":
            return "audio/x-aac";
            break;
        case "ahead":
            return "application/vnd.ahead.space";
            break;
        case "azf":
            return "application/vnd.airzip.filesecure.azf";
            break;
        case "azs":
            return "application/vnd.airzip.filesecure.azs";
            break;
        case "azw":
            return "application/vnd.amazon.ebook";
            break;
        case "ami":
            return "application/vnd.amiga.ami";
            break;
        case "N/A":
            return "application/andrew-inset";
            break;
        case "apk":
            return "application/vnd.android.package-archive";
            break;
        case "cii":
            return "application/vnd.anser-web-certificate-issue-initiation";
            break;
        case "fti":
            return "application/vnd.anser-web-funds-transfer-initiation";
            break;
        case "atx":
            return "application/vnd.antix.game-component";
            break;
        case "mpkg":
            return "application/vnd.apple.installer+xml";
            break;
        case "aw":
            return "application/applixware";
            break;
        case "les":
            return "application/vnd.hhe.lesson-player";
            break;
        case "swi":
            return "application/vnd.aristanetworks.swi";
            break;
        case "s":
            return "text/x-asm";
            break;
        case "atomcat":
            return "application/atomcat+xml";
            break;
        case "atomsvc":
            return "application/atomsvc+xml";
            break;
        case "atom, .xml":
            return "application/atom+xml";
            break;
        case "ac":
            return "application/pkix-attr-cert";
            break;
        case "aif":
            return "audio/x-aiff";
            break;
        case "avi":
            return "video/x-msvideo";
            break;
        case "aep":
            return "application/vnd.audiograph";
            break;
        case "dxf":
            return "image/vnd.dxf";
            break;
        case "dwf":
            return "model/vnd.dwf";
            break;
        case "par":
            return "text/plain-bas";
            break;
        case "bcpio":
            return "application/x-bcpio";
            break;
        case "bin":
            return "application/octet-stream";
            break;
        case "bmp":
            return "image/bmp";
            break;
        case "torrent":
            return "application/x-bittorrent";
            break;
        case "cod":
            return "application/vnd.rim.cod";
            break;
        case "mpm":
            return "application/vnd.blueice.multipass";
            break;
        case "bmi":
            return "application/vnd.bmi";
            break;
        case "sh":
            return "application/x-sh";
            break;
        case "btif":
            return "image/prs.btif";
            break;
        case "rep":
            return "application/vnd.businessobjects";
            break;
        case "bz":
            return "application/x-bzip";
            break;
        case "bz2":
            return "application/x-bzip2";
            break;
        case "csh":
            return "application/x-csh";
            break;
        case "c":
            return "text/x-c";
            break;
        case "cdxml":
            return "application/vnd.chemdraw+xml";
            break;
        case "css":
            return "text/css";
            break;
        case "cdx":
            return "chemical/x-cdx";
            break;
        case "cml":
            return "chemical/x-cml";
            break;
        case "csml":
            return "chemical/x-csml";
            break;
        case "cdbcmsg":
            return "application/vnd.contact.cmsg";
            break;
        case "cla":
            return "application/vnd.claymore";
            break;
        case "c4g":
            return "application/vnd.clonk.c4group";
            break;
        case "sub":
            return "image/vnd.dvb.subtitle";
            break;
        case "cdmia":
            return "application/cdmi-capability";
            break;
        case "cdmic":
            return "application/cdmi-container";
            break;
        case "cdmid":
            return "application/cdmi-domain";
            break;
        case "cdmio":
            return "application/cdmi-object";
            break;
        case "cdmiq":
            return "application/cdmi-queue";
            break;
        case "c11amc":
            return "application/vnd.cluetrust.cartomobile-config";
            break;
        case "c11amz":
            return "application/vnd.cluetrust.cartomobile-config-pkg";
            break;
        case "ras":
            return "image/x-cmu-raster";
            break;
        case "dae":
            return "model/vnd.collada+xml";
            break;
        case "csv":
            return "text/csv";
            break;
        case "cpt":
            return "application/mac-compactpro";
            break;
        case "wmlc":
            return "application/vnd.wap.wmlc";
            break;
        case "cgm":
            return "image/cgm";
            break;
        case "ice":
            return "x-conference/x-cooltalk";
            break;
        case "cmx":
            return "image/x-cmx";
            break;
        case "xar":
            return "application/vnd.xara";
            break;
        case "cmc":
            return "application/vnd.cosmocaller";
            break;
        case "cpio":
            return "application/x-cpio";
            break;
        case "clkx":
            return "application/vnd.crick.clicker";
            break;
        case "clkk":
            return "application/vnd.crick.clicker.keyboard";
            break;
        case "clkp":
            return "application/vnd.crick.clicker.palette";
            break;
        case "clkt":
            return "application/vnd.crick.clicker.template";
            break;
        case "clkw":
            return "application/vnd.crick.clicker.wordbank";
            break;
        case "wbs":
            return "application/vnd.criticaltools.wbs+xml";
            break;
        case "cryptonote":
            return "application/vnd.rig.cryptonote";
            break;
        case "cif":
            return "chemical/x-cif";
            break;
        case "cmdf":
            return "chemical/x-cmdf";
            break;
        case "cu":
            return "application/cu-seeme";
            break;
        case "cww":
            return "application/prs.cww";
            break;
        case "curl":
            return "text/vnd.curl";
            break;
        case "dcurl":
            return "text/vnd.curl.dcurl";
            break;
        case "mcurl":
            return "text/vnd.curl.mcurl";
            break;
        case "scurl":
            return "text/vnd.curl.scurl";
            break;
        case "car":
            return "application/vnd.curl.car";
            break;
        case "pcurl":
            return "application/vnd.curl.pcurl";
            break;
        case "cmp":
            return "application/vnd.yellowriver-custom-menu";
            break;
        case "dssc":
            return "application/dssc+der";
            break;
        case "xdssc":
            return "application/dssc+xml";
            break;
        case "deb":
            return "application/x-debian-package";
            break;
        case "uva":
            return "audio/vnd.dece.audio";
            break;
        case "uvi":
            return "image/vnd.dece.graphic";
            break;
        case "uvh":
            return "video/vnd.dece.hd";
            break;
        case "uvm":
            return "video/vnd.dece.mobile";
            break;
        case "uvu":
            return "video/vnd.uvvu.mp4";
            break;
        case "uvp":
            return "video/vnd.dece.pd";
            break;
        case "uvs":
            return "video/vnd.dece.sd";
            break;
        case "uvv":
            return "video/vnd.dece.video";
            break;
        case "dvi":
            return "application/x-dvi";
            break;
        case "seed":
            return "application/vnd.fdsn.seed";
            break;
        case "dtb":
            return "application/x-dtbook+xml";
            break;
        case "res":
            return "application/x-dtbresource+xml";
            break;
        case "ait":
            return "application/vnd.dvb.ait";
            break;
        case "svc":
            return "application/vnd.dvb.service";
            break;
        case "eol":
            return "audio/vnd.digital-winds";
            break;
        case "djvu":
            return "image/vnd.djvu";
            break;
        case "dtd":
            return "application/xml-dtd";
            break;
        case "mlp":
            return "application/vnd.dolby.mlp";
            break;
        case "wad":
            return "application/x-doom";
            break;
        case "dpg":
            return "application/vnd.dpgraph";
            break;
        case "dra":
            return "audio/vnd.dra";
            break;
        case "dfac":
            return "application/vnd.dreamfactory";
            break;
        case "dts":
            return "audio/vnd.dts";
            break;
        case "dtshd":
            return "audio/vnd.dts.hd";
            break;
        case "dwg":
            return "image/vnd.dwg";
            break;
        case "geo":
            return "application/vnd.dynageo";
            break;
        case "es":
            return "application/ecmascript";
            break;
        case "mag":
            return "application/vnd.ecowin.chart";
            break;
        case "mmr":
            return "image/vnd.fujixerox.edmics-mmr";
            break;
        case "rlc":
            return "image/vnd.fujixerox.edmics-rlc";
            break;
        case "exi":
            return "application/exi";
            break;
        case "mgz":
            return "application/vnd.proteus.magazine";
            break;
        case "epub":
            return "application/epub+zip";
            break;
        case "eml":
            return "message/rfc822";
            break;
        case "nml":
            return "application/vnd.enliven";
            break;
        case "xpr":
            return "application/vnd.is-xpr";
            break;
        case "xif":
            return "image/vnd.xiff";
            break;
        case "xfdl":
            return "application/vnd.xfdl";
            break;
        case "emma":
            return "application/emma+xml";
            break;
        case "ez2":
            return "application/vnd.ezpix-album";
            break;
        case "ez3":
            return "application/vnd.ezpix-package";
            break;
        case "fst":
            return "image/vnd.fst";
            break;
        case "fvt":
            return "video/vnd.fvt";
            break;
        case "fbs":
            return "image/vnd.fastbidsheet";
            break;
        case "fe_launch":
            return "application/vnd.denovo.fcselayout-link";
            break;
        case "f4v":
            return "video/x-f4v";
            break;
        case "flv":
            return "video/x-flv";
            break;
        case "fpx":
            return "image/vnd.fpx";
            break;
        case "npx":
            return "image/vnd.net-fpx";
            break;
        case "flx":
            return "text/vnd.fmi.flexstor";
            break;
        case "fli":
            return "video/x-fli";
            break;
        case "ftc":
            return "application/vnd.fluxtime.clip";
            break;
        case "fdf":
            return "application/vnd.fdf";
            break;
        case "f":
            return "text/x-fortran";
            break;
        case "mif":
            return "application/vnd.mif";
            break;
        case "fm":
            return "application/vnd.framemaker";
            break;
        case "fh":
            return "image/x-freehand";
            break;
        case "fsc":
            return "application/vnd.fsc.weblaunch";
            break;
        case "fnc":
            return "application/vnd.frogans.fnc";
            break;
        case "ltf":
            return "application/vnd.frogans.ltf";
            break;
        case "ddd":
            return "application/vnd.fujixerox.ddd";
            break;
        case "xdw":
            return "application/vnd.fujixerox.docuworks";
            break;
        case "xbd":
            return "application/vnd.fujixerox.docuworks.binder";
            break;
        case "oas":
            return "application/vnd.fujitsu.oasys";
            break;
        case "oa2":
            return "application/vnd.fujitsu.oasys2";
            break;
        case "oa3":
            return "application/vnd.fujitsu.oasys3";
            break;
        case "fg5":
            return "application/vnd.fujitsu.oasysgp";
            break;
        case "bh2":
            return "application/vnd.fujitsu.oasysprs";
            break;
        case "spl":
            return "application/x-futuresplash";
            break;
        case "fzs":
            return "application/vnd.fuzzysheet";
            break;
        case "g3":
            return "image/g3fax";
            break;
        case "gmx":
            return "application/vnd.gmx";
            break;
        case "gtw":
            return "model/vnd.gtw";
            break;
        case "txd":
            return "application/vnd.genomatix.tuxedo";
            break;
        case "ggb":
            return "application/vnd.geogebra.file";
            break;
        case "ggt":
            return "application/vnd.geogebra.tool";
            break;
        case "gdl":
            return "model/vnd.gdl";
            break;
        case "gex":
            return "application/vnd.geometry-explorer";
            break;
        case "gxt":
            return "application/vnd.geonext";
            break;
        case "g2w":
            return "application/vnd.geoplan";
            break;
        case "g3w":
            return "application/vnd.geospace";
            break;
        case "gsf":
            return "application/x-font-ghostscript";
            break;
        case "bdf":
            return "application/x-font-bdf";
            break;
        case "gtar":
            return "application/x-gtar";
            break;
        case "texinfo":
            return "application/x-texinfo";
            break;
        case "gnumeric":
            return "application/x-gnumeric";
            break;
        case "kml":
            return "application/vnd.google-earth.kml+xml";
            break;
        case "kmz":
            return "application/vnd.google-earth.kmz";
            break;
        case "gqf":
            return "application/vnd.grafeq";
            break;
        case "gif":
            return "image/gif";
            break;
        case "gv":
            return "text/vnd.graphviz";
            break;
        case "gac":
            return "application/vnd.groove-account";
            break;
        case "ghf":
            return "application/vnd.groove-help";
            break;
        case "gim":
            return "application/vnd.groove-identity-message";
            break;
        case "grv":
            return "application/vnd.groove-injector";
            break;
        case "gtm":
            return "application/vnd.groove-tool-message";
            break;
        case "tpl":
            return "application/vnd.groove-tool-template";
            break;
        case "vcg":
            return "application/vnd.groove-vcard";
            break;
        case "h261":
            return "video/h261";
            break;
        case "h263":
            return "video/h263";
            break;
        case "h264":
            return "video/h264";
            break;
        case "hpid":
            return "application/vnd.hp-hpid";
            break;
        case "hps":
            return "application/vnd.hp-hps";
            break;
        case "hdf":
            return "application/x-hdf";
            break;
        case "rip":
            return "audio/vnd.rip";
            break;
        case "hbci":
            return "application/vnd.hbci";
            break;
        case "jlt":
            return "application/vnd.hp-jlyt";
            break;
        case "pcl":
            return "application/vnd.hp-pcl";
            break;
        case "hpgl":
            return "application/vnd.hp-hpgl";
            break;
        case "hvs":
            return "application/vnd.yamaha.hv-script";
            break;
        case "hvd":
            return "application/vnd.yamaha.hv-dic";
            break;
        case "hvp":
            return "application/vnd.yamaha.hv-voice";
            break;
        case "sfd-hdstx":
            return "application/vnd.hydrostatix.sof-data";
            break;
        case "stk":
            return "application/hyperstudio";
            break;
        case "hal":
            return "application/vnd.hal+xml";
            break;
        case "html":
            return "text/html";
            break;
        case "irm":
            return "application/vnd.ibm.rights-management";
            break;
        case "sc":
            return "application/vnd.ibm.secure-container";
            break;
        case "ics":
            return "text/calendar";
            break;
        case "icc":
            return "application/vnd.iccprofile";
            break;
        case "ico":
            return "image/x-icon";
            break;
        case "igl":
            return "application/vnd.igloader";
            break;
        case "ief":
            return "image/ief";
            break;
        case "ivp":
            return "application/vnd.immervision-ivp";
            break;
        case "ivu":
            return "application/vnd.immervision-ivu";
            break;
        case "rif":
            return "application/reginfo+xml";
            break;
        case "3dml":
            return "text/vnd.in3d.3dml";
            break;
        case "spot":
            return "text/vnd.in3d.spot";
            break;
        case "igs":
            return "model/iges";
            break;
        case "i2g":
            return "application/vnd.intergeo";
            break;
        case "cdy":
            return "application/vnd.cinderella";
            break;
        case "xpw":
            return "application/vnd.intercon.formnet";
            break;
        case "fcs":
            return "application/vnd.isac.fcs";
            break;
        case "ipfix":
            return "application/ipfix";
            break;
        case "cer":
            return "application/pkix-cert";
            break;
        case "pki":
            return "application/pkixcmp";
            break;
        case "crl":
            return "application/pkix-crl";
            break;
        case "pkipath":
            return "application/pkix-pkipath";
            break;
        case "igm":
            return "application/vnd.insors.igm";
            break;
        case "rcprofile":
            return "application/vnd.ipunplugged.rcprofile";
            break;
        case "irp":
            return "application/vnd.irepository.package+xml";
            break;
        case "jad":
            return "text/vnd.sun.j2me.app-descriptor";
            break;
        case "jar":
            return "application/java-archive";
            break;
        case "class":
            return "application/java-vm";
            break;
        case "jnlp":
            return "application/x-java-jnlp-file";
            break;
        case "ser":
            return "application/java-serialized-object";
            break;
        case "java":
            return "text/x-java-source,java";
            break;
        case "js":
            return "application/javascript";
            break;
        case "json":
            return "application/json";
            break;
        case "joda":
            return "application/vnd.joost.joda-archive";
            break;
        case "jpm":
            return "video/jpm";
            break;
        case "jpeg, .jpg":
            return "image/jpeg";
            break;
        case "jpgv":
            return "video/jpeg";
            break;
        case "ktz":
            return "application/vnd.kahootz";
            break;
        case "mmd":
            return "application/vnd.chipnuts.karaoke-mmd";
            break;
        case "karbon":
            return "application/vnd.kde.karbon";
            break;
        case "chrt":
            return "application/vnd.kde.kchart";
            break;
        case "kfo":
            return "application/vnd.kde.kformula";
            break;
        case "flw":
            return "application/vnd.kde.kivio";
            break;
        case "kon":
            return "application/vnd.kde.kontour";
            break;
        case "kpr":
            return "application/vnd.kde.kpresenter";
            break;
        case "ksp":
            return "application/vnd.kde.kspread";
            break;
        case "kwd":
            return "application/vnd.kde.kword";
            break;
        case "htke":
            return "application/vnd.kenameaapp";
            break;
        case "kia":
            return "application/vnd.kidspiration";
            break;
        case "kne":
            return "application/vnd.kinar";
            break;
        case "sse":
            return "application/vnd.kodak-descriptor";
            break;
        case "lasxml":
            return "application/vnd.las.las+xml";
            break;
        case "latex":
            return "application/x-latex";
            break;
        case "lbd":
            return "application/vnd.llamagraphics.life-balance.desktop";
            break;
        case "lbe":
            return "application/vnd.llamagraphics.life-balance.exchange+xml";
            break;
        case "jam":
            return "application/vnd.jam";
            break;
        case "123":
            return "application/vnd.lotus-1-2-3";
            break;
        case "apr":
            return "application/vnd.lotus-approach";
            break;
        case "pre":
            return "application/vnd.lotus-freelance";
            break;
        case "nsf":
            return "application/vnd.lotus-notes";
            break;
        case "org":
            return "application/vnd.lotus-organizer";
            break;
        case "scm":
            return "application/vnd.lotus-screencam";
            break;
        case "lwp":
            return "application/vnd.lotus-wordpro";
            break;
        case "lvp":
            return "audio/vnd.lucent.voice";
            break;
        case "m3u":
            return "audio/x-mpegurl";
            break;
        case "m4v":
            return "video/x-m4v";
            break;
        case "hqx":
            return "application/mac-binhex40";
            break;
        case "portpkg":
            return "application/vnd.macports.portpkg";
            break;
        case "mgp":
            return "application/vnd.osgeo.mapguide.package";
            break;
        case "mrc":
            return "application/marc";
            break;
        case "mrcx":
            return "application/marcxml+xml";
            break;
        case "mxf":
            return "application/mxf";
            break;
        case "nbp":
            return "application/vnd.wolfram.player";
            break;
        case "ma":
            return "application/mathematica";
            break;
        case "mathml":
            return "application/mathml+xml";
            break;
        case "mbox":
            return "application/mbox";
            break;
        case "mc1":
            return "application/vnd.medcalcdata";
            break;
        case "mscml":
            return "application/mediaservercontrol+xml";
            break;
        case "cdkey":
            return "application/vnd.mediastation.cdkey";
            break;
        case "mwf":
            return "application/vnd.mfer";
            break;
        case "mfm":
            return "application/vnd.mfmp";
            break;
        case "msh":
            return "model/mesh";
            break;
        case "mads":
            return "application/mads+xml";
            break;
        case "mets":
            return "application/mets+xml";
            break;
        case "mods":
            return "application/mods+xml";
            break;
        case "meta4":
            return "application/metalink4+xml";
            break;
        case "potm":
            return "application/vnd.ms-powerpoint.template.macroenabled.12";
            break;
        case "docm":
            return "application/vnd.ms-word.document.macroenabled.12";
            break;
        case "dotm":
            return "application/vnd.ms-word.template.macroenabled.12";
            break;
        case "mcd":
            return "application/vnd.mcd";
            break;
        case "flo":
            return "application/vnd.micrografx.flo";
            break;
        case "igx":
            return "application/vnd.micrografx.igx";
            break;
        case "es3":
            return "application/vnd.eszigno3+xml";
            break;
        case "mdb":
            return "application/x-msaccess";
            break;
        case "asf":
            return "video/x-ms-asf";
            break;
        case "exe":
            return "application/x-msdownload";
            break;
        case "cil":
            return "application/vnd.ms-artgalry";
            break;
        case "cab":
            return "application/vnd.ms-cab-compressed";
            break;
        case "ims":
            return "application/vnd.ms-ims";
            break;
        case "application":
            return "application/x-ms-application";
            break;
        case "clp":
            return "application/x-msclip";
            break;
        case "mdi":
            return "image/vnd.ms-modi";
            break;
        case "eot":
            return "application/vnd.ms-fontobject";
            break;
        case "xls":
            return "application/vnd.ms-excel";
            break;
        case "xlam":
            return "application/vnd.ms-excel.addin.macroenabled.12";
            break;
        case "xlsb":
            return "application/vnd.ms-excel.sheet.binary.macroenabled.12";
            break;
        case "xltm":
            return "application/vnd.ms-excel.template.macroenabled.12";
            break;
        case "xlsm":
            return "application/vnd.ms-excel.sheet.macroenabled.12";
            break;
        case "chm":
            return "application/vnd.ms-htmlhelp";
            break;
        case "crd":
            return "application/x-mscardfile";
            break;
        case "lrm":
            return "application/vnd.ms-lrm";
            break;
        case "mvb":
            return "application/x-msmediaview";
            break;
        case "mny":
            return "application/x-msmoney";
            break;
        case "pptx":
            return "application/vnd.openxmlformats-officedocument.presentationml.presentation";
            break;
        case "sldx":
            return "application/vnd.openxmlformats-officedocument.presentationml.slide";
            break;
        case "ppsx":
            return "application/vnd.openxmlformats-officedocument.presentationml.slideshow";
            break;
        case "potx":
            return "application/vnd.openxmlformats-officedocument.presentationml.template";
            break;
        case "xlsx":
            return "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
            break;
        case "xltx":
            return "application/vnd.openxmlformats-officedocument.spreadsheetml.template";
            break;
        case "docx":
            return "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
            break;
        case "dotx":
            return "application/vnd.openxmlformats-officedocument.wordprocessingml.template";
            break;
        case "obd":
            return "application/x-msbinder";
            break;
        case "thmx":
            return "application/vnd.ms-officetheme";
            break;
        case "onetoc":
            return "application/onenote";
            break;
        case "pya":
            return "audio/vnd.ms-playready.media.pya";
            break;
        case "pyv":
            return "video/vnd.ms-playready.media.pyv";
            break;
        case "ppt":
            return "application/vnd.ms-powerpoint";
            break;
        case "ppam":
            return "application/vnd.ms-powerpoint.addin.macroenabled.12";
            break;
        case "sldm":
            return "application/vnd.ms-powerpoint.slide.macroenabled.12";
            break;
        case "pptm":
            return "application/vnd.ms-powerpoint.presentation.macroenabled.12";
            break;
        case "ppsm":
            return "application/vnd.ms-powerpoint.slideshow.macroenabled.12";
            break;
        case "mpp":
            return "application/vnd.ms-project";
            break;
        case "pub":
            return "application/x-mspublisher";
            break;
        case "scd":
            return "application/x-msschedule";
            break;
        case "xap":
            return "application/x-silverlight-app";
            break;
        case "stl":
            return "application/vnd.ms-pki.stl";
            break;
        case "cat":
            return "application/vnd.ms-pki.seccat";
            break;
        case "vsd":
            return "application/vnd.visio";
            break;
        case "wm":
            return "video/x-ms-wm";
            break;
        case "wma":
            return "audio/x-ms-wma";
            break;
        case "wax":
            return "audio/x-ms-wax";
            break;
        case "wmx":
            return "video/x-ms-wmx";
            break;
        case "wmd":
            return "application/x-ms-wmd";
            break;
        case "wpl":
            return "application/vnd.ms-wpl";
            break;
        case "wmz":
            return "application/x-ms-wmz";
            break;
        case "wmv":
            return "video/x-ms-wmv";
            break;
        case "wvx":
            return "video/x-ms-wvx";
            break;
        case "wmf":
            return "application/x-msmetafile";
            break;
        case "trm":
            return "application/x-msterminal";
            break;
        case "doc":
            return "application/msword";
            break;
        case "wri":
            return "application/x-mswrite";
            break;
        case "wps":
            return "application/vnd.ms-works";
            break;
        case "xbap":
            return "application/x-ms-xbap";
            break;
        case "xps":
            return "application/vnd.ms-xpsdocument";
            break;
        case "mid":
            return "audio/midi";
            break;
        case "mpy":
            return "application/vnd.ibm.minipay";
            break;
        case "afp":
            return "application/vnd.ibm.modcap";
            break;
        case "rms":
            return "application/vnd.jcp.javame.midlet-rms";
            break;
        case "tmo":
            return "application/vnd.tmobile-livetv";
            break;
        case "prc":
            return "application/x-mobipocket-ebook";
            break;
        case "mbk":
            return "application/vnd.mobius.mbk";
            break;
        case "dis":
            return "application/vnd.mobius.dis";
            break;
        case "plc":
            return "application/vnd.mobius.plc";
            break;
        case "mqy":
            return "application/vnd.mobius.mqy";
            break;
        case "msl":
            return "application/vnd.mobius.msl";
            break;
        case "txf":
            return "application/vnd.mobius.txf";
            break;
        case "daf":
            return "application/vnd.mobius.daf";
            break;
        case "fly":
            return "text/vnd.fly";
            break;
        case "mpc":
            return "application/vnd.mophun.certificate";
            break;
        case "mpn":
            return "application/vnd.mophun.application";
            break;
        case "mj2":
            return "video/mj2";
            break;
        case "mpga":
            return "audio/mpeg";
            break;
        case "mxu":
            return "video/vnd.mpegurl";
            break;
        case "mpeg":
            return "video/mpeg";
            break;
        case "m21":
            return "application/mp21";
            break;
        case "mp4a":
            return "audio/mp4";
            break;
        case "mp4":
            return "video/mp4";
            break;
        case "mp4":
            return "application/mp4";
            break;
        case "m3u8":
            return "application/vnd.apple.mpegurl";
            break;
        case "mus":
            return "application/vnd.musician";
            break;
        case "msty":
            return "application/vnd.muvee.style";
            break;
        case "mxml":
            return "application/xv+xml";
            break;
        case "ngdat":
            return "application/vnd.nokia.n-gage.data";
            break;
        case "n-gage":
            return "application/vnd.nokia.n-gage.symbian.install";
            break;
        case "ncx":
            return "application/x-dtbncx+xml";
            break;
        case "nc":
            return "application/x-netcdf";
            break;
        case "nlu":
            return "application/vnd.neurolanguage.nlu";
            break;
        case "dna":
            return "application/vnd.dna";
            break;
        case "nnd":
            return "application/vnd.noblenet-directory";
            break;
        case "nns":
            return "application/vnd.noblenet-sealer";
            break;
        case "nnw":
            return "application/vnd.noblenet-web";
            break;
        case "rpst":
            return "application/vnd.nokia.radio-preset";
            break;
        case "rpss":
            return "application/vnd.nokia.radio-presets";
            break;
        case "n3":
            return "text/n3";
            break;
        case "edm":
            return "application/vnd.novadigm.edm";
            break;
        case "edx":
            return "application/vnd.novadigm.edx";
            break;
        case "ext":
            return "application/vnd.novadigm.ext";
            break;
        case "gph":
            return "application/vnd.flographit";
            break;
        case "ecelp4800":
            return "audio/vnd.nuera.ecelp4800";
            break;
        case "ecelp7470":
            return "audio/vnd.nuera.ecelp7470";
            break;
        case "ecelp9600":
            return "audio/vnd.nuera.ecelp9600";
            break;
        case "oda":
            return "application/oda";
            break;
        case "ogx":
            return "application/ogg";
            break;
        case "oga":
            return "audio/ogg";
            break;
        case "ogv":
            return "video/ogg";
            break;
        case "dd2":
            return "application/vnd.oma.dd2+xml";
            break;
        case "oth":
            return "application/vnd.oasis.opendocument.text-web";
            break;
        case "opf":
            return "application/oebps-package+xml";
            break;
        case "qbo":
            return "application/vnd.intu.qbo";
            break;
        case "oxt":
            return "application/vnd.openofficeorg.extension";
            break;
        case "osf":
            return "application/vnd.yamaha.openscoreformat";
            break;
        case "weba":
            return "audio/webm";
            break;
        case "webm":
            return "video/webm";
            break;
        case "odc":
            return "application/vnd.oasis.opendocument.chart";
            break;
        case "otc":
            return "application/vnd.oasis.opendocument.chart-template";
            break;
        case "odb":
            return "application/vnd.oasis.opendocument.database";
            break;
        case "odf":
            return "application/vnd.oasis.opendocument.formula";
            break;
        case "odft":
            return "application/vnd.oasis.opendocument.formula-template";
            break;
        case "odg":
            return "application/vnd.oasis.opendocument.graphics";
            break;
        case "otg":
            return "application/vnd.oasis.opendocument.graphics-template";
            break;
        case "odi":
            return "application/vnd.oasis.opendocument.image";
            break;
        case "oti":
            return "application/vnd.oasis.opendocument.image-template";
            break;
        case "odp":
            return "application/vnd.oasis.opendocument.presentation";
            break;
        case "otp":
            return "application/vnd.oasis.opendocument.presentation-template";
            break;
        case "ods":
            return "application/vnd.oasis.opendocument.spreadsheet";
            break;
        case "ots":
            return "application/vnd.oasis.opendocument.spreadsheet-template";
            break;
        case "odt":
            return "application/vnd.oasis.opendocument.text";
            break;
        case "odm":
            return "application/vnd.oasis.opendocument.text-master";
            break;
        case "ott":
            return "application/vnd.oasis.opendocument.text-template";
            break;
        case "ktx":
            return "image/ktx";
            break;
        case "sxc":
            return "application/vnd.sun.xml.calc";
            break;
        case "stc":
            return "application/vnd.sun.xml.calc.template";
            break;
        case "sxd":
            return "application/vnd.sun.xml.draw";
            break;
        case "std":
            return "application/vnd.sun.xml.draw.template";
            break;
        case "sxi":
            return "application/vnd.sun.xml.impress";
            break;
        case "sti":
            return "application/vnd.sun.xml.impress.template";
            break;
        case "sxm":
            return "application/vnd.sun.xml.math";
            break;
        case "sxw":
            return "application/vnd.sun.xml.writer";
            break;
        case "sxg":
            return "application/vnd.sun.xml.writer.global";
            break;
        case "stw":
            return "application/vnd.sun.xml.writer.template";
            break;
        case "otf":
            return "application/x-font-otf";
            break;
        case "osfpvg":
            return "application/vnd.yamaha.openscoreformat.osfpvg+xml";
            break;
        case "dp":
            return "application/vnd.osgi.dp";
            break;
        case "pdb":
            return "application/vnd.palm";
            break;
        case "p":
            return "text/x-pascal";
            break;
        case "paw":
            return "application/vnd.pawaafile";
            break;
        case "pclxl":
            return "application/vnd.hp-pclxl";
            break;
        case "efif":
            return "application/vnd.picsel";
            break;
        case "pcx":
            return "image/x-pcx";
            break;
        case "psd":
            return "image/vnd.adobe.photoshop";
            break;
        case "prf":
            return "application/pics-rules";
            break;
        case "pic":
            return "image/x-pict";
            break;
        case "chat":
            return "application/x-chat";
            break;
        case "p10":
            return "application/pkcs10";
            break;
        case "p12":
            return "application/x-pkcs12";
            break;
        case "p7m":
            return "application/pkcs7-mime";
            break;
        case "p7s":
            return "application/pkcs7-signature";
            break;
        case "p7r":
            return "application/x-pkcs7-certreqresp";
            break;
        case "p7b":
            return "application/x-pkcs7-certificates";
            break;
        case "p8":
            return "application/pkcs8";
            break;
        case "plf":
            return "application/vnd.pocketlearn";
            break;
        case "pnm":
            return "image/x-portable-anymap";
            break;
        case "pbm":
            return "image/x-portable-bitmap";
            break;
        case "pcf":
            return "application/x-font-pcf";
            break;
        case "pfr":
            return "application/font-tdpfr";
            break;
        case "pgn":
            return "application/x-chess-pgn";
            break;
        case "pgm":
            return "image/x-portable-graymap";
            break;
        case "png":
            return "image/png";
            break;
        case "ppm":
            return "image/x-portable-pixmap";
            break;
        case "pskcxml":
            return "application/pskc+xml";
            break;
        case "pml":
            return "application/vnd.ctc-posml";
            break;
        case "ai":
            return "application/postscript";
            break;
        case "pfa":
            return "application/x-font-type1";
            break;
        case "pbd":
            return "application/vnd.powerbuilder6";
            break;
        case "pgp":
            return "application/pgp-signature";
            break;
        case "box":
            return "application/vnd.previewsystems.box";
            break;
        case "ptid":
            return "application/vnd.pvi.ptid1";
            break;
        case "pls":
            return "application/pls+xml";
            break;
        case "str":
            return "application/vnd.pg.format";
            break;
        case "ei6":
            return "application/vnd.pg.osasli";
            break;
        case "dsc":
            return "text/prs.lines.tag";
            break;
        case "psf":
            return "application/x-font-linux-psf";
            break;
        case "qps":
            return "application/vnd.publishare-delta-tree";
            break;
        case "wg":
            return "application/vnd.pmi.widget";
            break;
        case "qxd":
            return "application/vnd.quark.quarkxpress";
            break;
        case "esf":
            return "application/vnd.epson.esf";
            break;
        case "msf":
            return "application/vnd.epson.msf";
            break;
        case "ssf":
            return "application/vnd.epson.ssf";
            break;
        case "qam":
            return "application/vnd.epson.quickanime";
            break;
        case "qfx":
            return "application/vnd.intu.qfx";
            break;
        case "qt":
            return "video/quicktime";
            break;
        case "rar":
            return "application/x-rar-compressed";
            break;
        case "ram":
            return "audio/x-pn-realaudio";
            break;
        case "rmp":
            return "audio/x-pn-realaudio-plugin";
            break;
        case "rsd":
            return "application/rsd+xml";
            break;
        case "rm":
            return "application/vnd.rn-realmedia";
            break;
        case "bed":
            return "application/vnd.realvnc.bed";
            break;
        case "mxl":
            return "application/vnd.recordare.musicxml";
            break;
        case "musicxml":
            return "application/vnd.recordare.musicxml+xml";
            break;
        case "rnc":
            return "application/relax-ng-compact-syntax";
            break;
        case "rdz":
            return "application/vnd.data-vision.rdz";
            break;
        case "rdf":
            return "application/rdf+xml";
            break;
        case "rp9":
            return "application/vnd.cloanto.rp9";
            break;
        case "jisp":
            return "application/vnd.jisp";
            break;
        case "rtf":
            return "application/rtf";
            break;
        case "rtx":
            return "text/richtext";
            break;
        case "link66":
            return "application/vnd.route66.link66+xml";
            break;
        case "rss, .xml":
            return "application/rss+xml";
            break;
        case "shf":
            return "application/shf+xml";
            break;
        case "st":
            return "application/vnd.sailingtracker.track";
            break;
        case "svg":
            return "image/svg+xml";
            break;
        case "sus":
            return "application/vnd.sus-calendar";
            break;
        case "sru":
            return "application/sru+xml";
            break;
        case "setpay":
            return "application/set-payment-initiation";
            break;
        case "setreg":
            return "application/set-registration-initiation";
            break;
        case "sema":
            return "application/vnd.sema";
            break;
        case "semd":
            return "application/vnd.semd";
            break;
        case "semf":
            return "application/vnd.semf";
            break;
        case "see":
            return "application/vnd.seemail";
            break;
        case "snf":
            return "application/x-font-snf";
            break;
        case "spq":
            return "application/scvp-vp-request";
            break;
        case "spp":
            return "application/scvp-vp-response";
            break;
        case "scq":
            return "application/scvp-cv-request";
            break;
        case "scs":
            return "application/scvp-cv-response";
            break;
        case "sdp":
            return "application/sdp";
            break;
        case "etx":
            return "text/x-setext";
            break;
        case "movie":
            return "video/x-sgi-movie";
            break;
        case "ifm":
            return "application/vnd.shana.informed.formdata";
            break;
        case "itp":
            return "application/vnd.shana.informed.formtemplate";
            break;
        case "iif":
            return "application/vnd.shana.informed.interchange";
            break;
        case "ipk":
            return "application/vnd.shana.informed.package";
            break;
        case "tfi":
            return "application/thraud+xml";
            break;
        case "shar":
            return "application/x-shar";
            break;
        case "rgb":
            return "image/x-rgb";
            break;
        case "slt":
            return "application/vnd.epson.salt";
            break;
        case "aso":
            return "application/vnd.accpac.simply.aso";
            break;
        case "imp":
            return "application/vnd.accpac.simply.imp";
            break;
        case "twd":
            return "application/vnd.simtech-mindmapper";
            break;
        case "csp":
            return "application/vnd.commonspace";
            break;
        case "saf":
            return "application/vnd.yamaha.smaf-audio";
            break;
        case "mmf":
            return "application/vnd.smaf";
            break;
        case "spf":
            return "application/vnd.yamaha.smaf-phrase";
            break;
        case "teacher":
            return "application/vnd.smart.teacher";
            break;
        case "svd":
            return "application/vnd.svd";
            break;
        case "rq":
            return "application/sparql-query";
            break;
        case "srx":
            return "application/sparql-results+xml";
            break;
        case "gram":
            return "application/srgs";
            break;
        case "grxml":
            return "application/srgs+xml";
            break;
        case "ssml":
            return "application/ssml+xml";
            break;
        case "skp":
            return "application/vnd.koan";
            break;
        case "sgml":
            return "text/sgml";
            break;
        case "sdc":
            return "application/vnd.stardivision.calc";
            break;
        case "sda":
            return "application/vnd.stardivision.draw";
            break;
        case "sdd":
            return "application/vnd.stardivision.impress";
            break;
        case "smf":
            return "application/vnd.stardivision.math";
            break;
        case "sdw":
            return "application/vnd.stardivision.writer";
            break;
        case "sgl":
            return "application/vnd.stardivision.writer-global";
            break;
        case "sm":
            return "application/vnd.stepmania.stepchart";
            break;
        case "sit":
            return "application/x-stuffit";
            break;
        case "sitx":
            return "application/x-stuffitx";
            break;
        case "sdkm":
            return "application/vnd.solent.sdkm+xml";
            break;
        case "xo":
            return "application/vnd.olpc-sugar";
            break;
        case "au":
            return "audio/basic";
            break;
        case "wqd":
            return "application/vnd.wqd";
            break;
        case "sis":
            return "application/vnd.symbian.install";
            break;
        case "smi":
            return "application/smil+xml";
            break;
        case "xsm":
            return "application/vnd.syncml+xml";
            break;
        case "bdm":
            return "application/vnd.syncml.dm+wbxml";
            break;
        case "xdm":
            return "application/vnd.syncml.dm+xml";
            break;
        case "sv4cpio":
            return "application/x-sv4cpio";
            break;
        case "sv4crc":
            return "application/x-sv4crc";
            break;
        case "sbml":
            return "application/sbml+xml";
            break;
        case "tsv":
            return "text/tab-separated-values";
            break;
        case "tiff":
            return "image/tiff";
            break;
        case "tao":
            return "application/vnd.tao.intent-module-archive";
            break;
        case "tar":
            return "application/x-tar";
            break;
        case "tcl":
            return "application/x-tcl";
            break;
        case "tex":
            return "application/x-tex";
            break;
        case "tfm":
            return "application/x-tex-tfm";
            break;
        case "tei":
            return "application/tei+xml";
            break;
        case "txt":
            return "text/plain";
            break;
        case "dxp":
            return "application/vnd.spotfire.dxp";
            break;
        case "sfs":
            return "application/vnd.spotfire.sfs";
            break;
        case "tsd":
            return "application/timestamped-data";
            break;
        case "tpt":
            return "application/vnd.trid.tpt";
            break;
        case "mxs":
            return "application/vnd.triscape.mxs";
            break;
        case "t":
            return "text/troff";
            break;
        case "tra":
            return "application/vnd.trueapp";
            break;
        case "ttf":
            return "application/x-font-ttf";
            break;
        case "ttl":
            return "text/turtle";
            break;
        case "umj":
            return "application/vnd.umajin";
            break;
        case "uoml":
            return "application/vnd.uoml+xml";
            break;
        case "unityweb":
            return "application/vnd.unity";
            break;
        case "ufd":
            return "application/vnd.ufdl";
            break;
        case "uri":
            return "text/uri-list";
            break;
        case "utz":
            return "application/vnd.uiq.theme";
            break;
        case "ustar":
            return "application/x-ustar";
            break;
        case "uu":
            return "text/x-uuencode";
            break;
        case "vcs":
            return "text/x-vcalendar";
            break;
        case "vcf":
            return "text/x-vcard";
            break;
        case "vcd":
            return "application/x-cdlink";
            break;
        case "vsf":
            return "application/vnd.vsf";
            break;
        case "wrl":
            return "model/vrml";
            break;
        case "vcx":
            return "application/vnd.vcx";
            break;
        case "mts":
            return "model/vnd.mts";
            break;
        case "vtu":
            return "model/vnd.vtu";
            break;
        case "vis":
            return "application/vnd.visionary";
            break;
        case "viv":
            return "video/vnd.vivo";
            break;
        case "ccxml":
            return "application/ccxml+xml,";
            break;
        case "vxml":
            return "application/voicexml+xml";
            break;
        case "src":
            return "application/x-wais-source";
            break;
        case "wbxml":
            return "application/vnd.wap.wbxml";
            break;
        case "wbmp":
            return "image/vnd.wap.wbmp";
            break;
        case "wav":
            return "audio/x-wav";
            break;
        case "davmount":
            return "application/davmount+xml";
            break;
        case "woff":
            return "application/x-font-woff";
            break;
        case "wspolicy":
            return "application/wspolicy+xml";
            break;
        case "webp":
            return "image/webp";
            break;
        case "wtb":
            return "application/vnd.webturbo";
            break;
        case "wgt":
            return "application/widget";
            break;
        case "hlp":
            return "application/winhlp";
            break;
        case "wml":
            return "text/vnd.wap.wml";
            break;
        case "wmls":
            return "text/vnd.wap.wmlscript";
            break;
        case "wmlsc":
            return "application/vnd.wap.wmlscriptc";
            break;
        case "wpd":
            return "application/vnd.wordperfect";
            break;
        case "stf":
            return "application/vnd.wt.stf";
            break;
        case "wsdl":
            return "application/wsdl+xml";
            break;
        case "xbm":
            return "image/x-xbitmap";
            break;
        case "xpm":
            return "image/x-xpixmap";
            break;
        case "xwd":
            return "image/x-xwindowdump";
            break;
        case "der":
            return "application/x-x509-ca-cert";
            break;
        case "fig":
            return "application/x-xfig";
            break;
        case "xhtml":
            return "application/xhtml+xml";
            break;
        case "xml":
            return "application/xml";
            break;
        case "xdf":
            return "application/xcap-diff+xml";
            break;
        case "xenc":
            return "application/xenc+xml";
            break;
        case "xer":
            return "application/patch-ops-error+xml";
            break;
        case "rl":
            return "application/resource-lists+xml";
            break;
        case "rs":
            return "application/rls-services+xml";
            break;
        case "rld":
            return "application/resource-lists-diff+xml";
            break;
        case "xslt":
            return "application/xslt+xml";
            break;
        case "xop":
            return "application/xop+xml";
            break;
        case "xpi":
            return "application/x-xpinstall";
            break;
        case "xspf":
            return "application/xspf+xml";
            break;
        case "xul":
            return "application/vnd.mozilla.xul+xml";
            break;
        case "xyz":
            return "chemical/x-xyz";
            break;
        case "yaml":
            return "text/yaml";
            break;
        case "yang":
            return "application/yang";
            break;
        case "yin":
            return "application/yin+xml";
            break;
        case "zir":
            return "application/vnd.zul";
            break;
        case "zip":
            return "application/zip";
            break;
        case "zmm":
            return "application/vnd.handheld-entertainment+xml";
            break;
        case "zaz":
            return "application/vnd.zzazz.deck+xml";
            break;
        default:
            return "Unsupported type";
    }
}
