@echo on
set ogr_path="ogr2ogr\ogr2ogr.exe"
set current_kml_path="kml\SKM_TP_20200303.kml"
set current_json_path="in\SKM_TP_20200303.json"
%ogr_path% -f KML %current_kml_path% %current_json_path%
pause