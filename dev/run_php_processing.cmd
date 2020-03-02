@echo on
REM ogr2ogr.exe -f KML ..\kml\SKM_TP_20200101.KML ..\in\SKM_TP_20200101.json
cd .\in\

FOR %%f IN (*.json) do (
  echo %%f
  ..\ogr2ogr\ogr2ogr.exe -f KML ..\kml\%%f.kml .\%%f
)


set php="D:\!_Mchs\xampp\php\php.exe"
%php% -f D:\!_Mchs\1_json_from_srv.php

..\ogr2ogr\ogr2ogr.exe -f KML ..\kml\%%f.kml .\%%f
