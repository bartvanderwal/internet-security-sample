# WebTech - Internet Security workshop.
Welkom. Dit is een simpele opzet van een blog website zoals beoogd bij BP2.
Code is verre van af, dus maak het zelf af, of verwijder nog niet gebruikte code (zoals die van de session).
Zorg dat je het kunt toelichten bij het assessment :).

Hiermee kun je tevens security aspecten bekijken, en hierop SQL injection (SQLi) aanval tonen en een Cross Site Scripting (XSS) aanval. Hieronder een kort onderzoek via een hoofvraag en 3 deelvragen.

De conclusie geeft een samenvatting van de kern en hoe beveiligingsproblemen te voorkomen. Voor goed begrip is het echter, net als bij programmeren zelf - essentieel hiermee aan de slag te gaan, dus de code te doorlopen, en zelf eens als een hacker na te denken, en te ontdekken hoe code succesvol te injecteren.

## Beveiligingsonderzoek
Hoofdvraag: Hoe beveilig ik mijn website tegen hacks?

### Deelvragen:
1. Waar zitten de zwakke plekken in mijn website?
2. Hoe maken hackers gebruik van deze zwakke plekken?
3. Hoe kan het misbruiken van deze zwakke plekken onmogelijk maken via mijn applicatie code?

### Antwoorden:
1. De zwakke plekken zitten in de inputs (input velden) (we gaan uit van situatie dat hacker niet dysiek ij je bronbestanden kan)
2. De hacker kan hier tekst invoeren, de key is om geen inactieve data in te voeren, maar commando's, hetzij SQL commando's, hetzij javascript.
3. De essentie van gebruik actieve plekken is het switchen van onschuldige data naar actieve tekst, door op zich kleine dingen die je als programmeur leert kennen, zoals de sluit quote (') in een SQL string en de SQL comment `--` of de <script> html tag of `onLoad=` of `onClick=` attributen van HTML om JavaScript code in te voeren en op een site actief te krijgen, zodat de browser van een nietsvermoedende andere gebruiker deze gaat uitvoeren.

## Conclusie
Sommige security zaken liggen buiten bereik in deze WT course, zoals het gebruiken van SSL certificaten, of het inbouwen van wachttijden bij veelvuldig foute wachtwoord raden, om het brute force raken hiervan te voorkomen. Maar twee vormen van hacking kan (en moet je dan ook) in je applicatie code afvangen. Namelijk de al genoemde XSS en SQL injection.

Er zijn hiermee veel vormen van fraude en misbruik mogelijk, van defamation door vervelende plaatjes op een site te tonen in plaats van de orginele, of hinderlijke popup teksten, tot het verwijderen van gegevens uit de database, tot zelfs naar buiten communiceren van wachtwoorden of sessie (id's) om zo sessies te stelen/overnemen.

Gebruik PDO met prepared statements om SQL injectie te voorkomen op pleken waar gebruikersinput in je queries gebruikt wordt. Omdat het verschil tussen de `->query()` en veiligere `->prepare()` en `->execute(params..)` combinatie niet zo groot is, is het een goede gewoonte dit overal te doen. Strikt genomen is op een plek waar geen 'variabelen' in een query een `->query()` hierbij niet nodig. Maar dit komt niet vaak voor, en kan in de toekomst veranderen, wellicht door een andere developer die hier minder alert op is. NB Frequent gemaakt fout is het gebruik van PHP's string interpolatie (`$variabele`). Maar dan is ook de tweestaps raket `->prepare()` en `->execute(params..)` alsnog niet veilig. Het is essentieel voor echte prepared statements altijd de variant met `?` of de `:veld` syntax ipv `$` syntax te gebruiken, zoals ook aangeleerd/gegeven in de lessen/lessheets.

Gebruik `htmlentities` of soortgelijke standaard PHP functies om javascript code de-actief te maken, of strip de tags en zorg dat er helemaal geen HTML in je database kan komen. Basis aanpak is dit te doen op alle plekken waar gebruiker HTML/Javascript kan invoeren. Efficient aanpak is hierbij te richten op plekken waar deze code aan andere (te exploiten) gebruikers. Op andere plekken kan een hacker typisch alleen maar zichzelf lastig vallen (er moet dus wel een 'cross site' aspect mogelijk zijn voor reeel gevaar te vormen.
