<div id="kategori" spry:region="dsKategori dsProduk">
    <ul spry:repeatchildren="dsKategori">
        <li>{nama}
            <ul>
                <li spry:repeat="dsProduk" spry:test="'{dsKategori::token}'=='{dsProduk::kategori_token}'">
                    <a href=".?kat={dsKategori::ds_RowID}&amp;prd={dsProduk::ds_RowID}">{dsProduk::nama}</a>                
                </li>
            </ul>
        </li>
    </ul>
</div>