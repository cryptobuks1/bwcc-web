ECHO OFF
::CMD will no longer show us what command it’s executing(cleaner)
ECHO Send to Cloud Server
:: Print some text
curl http://localhost/bwcc/clinic_to_server/public/db/upload/live?key=m3svkHTbtMPiuIHybgdjDjsW2hEE29YN
:: Add your custom cURL command here.