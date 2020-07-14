ECHO OFF
::CMD will no longer show us what command it’s executing(cleaner)
ECHO Check Ms Access is Available or Not
:: Print some text
curl http://localhost/bwcc/clinic_to_server/public/db/local/check?key=m3svkHTbtMPiuIHybgdjDjsW2hEE29YN
:: Add your custom cURL command here.
:: Give the user some time to see the results. Because this is our last line, the program will exit and the command window will close once this line finishes.