# WebTech - Internet Security workshop.
Dit is een simpele opzet van een blog website met bijbehorende Database via 'PDO connectie' zoals beoogd bij BP2. Er zijn 2 pagina's:
- een 'last blogposts' pagina, waar je tevens nieuw blog post kunt invoegen via formulier.
- een (all) blogposts pagina, waarbinnen je kunt filteren

Met deze 'proof of concept' kun je tevens security aspecten bekijken, en hierop SQL injection (SQLi) aanval uitprobere en een Cross Site Scripting (XSS) aanval. Hieronder een kort onderzoek via een hoofvraag en 3 deelvragen.

De conclusie geeft een samenvatting van de kern en hoe beveiligingsproblemen te voorkomen. Voor goed begrip is het echter, net als bij programmeren zelf - essentieel hiermee aan de slag te gaan, dus de code te doorlopen, en zelf eens als een hacker na te denken, en te ontdekken hoe code succesvol te injecteren.

## Beveiligingsonderzoek
Hoofdvraag: Hoe beveilig ik mijn website tegen hacks?

### Deelvragen:
Bij bovenstaande hoofdvraag 
1. Waar zitten de zwakke plekken in mijn website?
2. Hoe maken hackers gebruik van deze zwakke plekken?
3. Hoe kan het misbruiken van deze zwakke plekken onmogelijk maken via aanpassingen mijn applicatie code?

De 'aanpassingen' van je code zijn feitelijk de beveligingsstandaarden waar je je aan moet houden om een veilige website

### Antwoorden:
1. De zwakke plekken zitten in de input mogelijkheden van de website (input velden) (we gaan uit van situatie dat hacker niet fysiek bij je bronbestanden, of je server of database)
2. De hacker kan hier tekst invoeren, de key is om geen inactieve data in te voeren, maar commando's, hetzij SQL commando's, hetzij javascript.
3. De essentie van gebruik actieve plekken is het switchen van onschuldige data naar actieve tekst, door op zich kleine dingen die je als programmeur leert kennen, zoals de sluit quote (') in een SQL string en de SQL comment `--` of de <script> html tag of `onLoad=` of `onClick=` attributen van HTML om JavaScript code in te voeren en op een site actief te krijgen, zodat de browser van een nietsvermoedende andere gebruiker deze gaat uitvoeren.

## Analyse
Sommige security zaken zijn in real life wel belangrijk, maar zijn niet verplicht om te bekijken in deze WT course.
- Bijvoorbeeld het gebruiken van SSL certificaten om een https verbinding te maken, direct tussen eindgebruiker en website
- het inbouwen van wachttijden en of 'exponential back-off' bij veelvuldig fout wachtwoord raden van het wachtwoord, om het brute force raken hiervan te voorkomen.
- Hashen van wachwoorden

Er zijn twee vormen van hacking kan die je wel in je applicatie code moet afvangen:
- Cross site scripting (XSS); het injecteren van JavaScript via HTML tags of attributen in de database (`<script>` of `onLoad=""`
- SQL injection, het injecteren van ongewenste SQL commando's, zoals `drop table users;` of `update users set password=` die de applicatie dan op de database gaat uitvoeren

Met deze twee technieken zijn veel vormen van fraude en misbruik mogelijk, van defamation door vervelende plaatjes op een site te tonen in plaats van de orginele, of hinderlijke popup (`alert()`) teksten, tot het verwijderen van gegevens uit de database, tot zelfs naar buiten communiceren van wachtwoorden of sessie (id's) (via js's `XmlHttpRequest` of de nieuwere `fetch(...)`om zo sessies te kunnen stelen/overnemen.

# Extra: Ho to hash
Naast deze twee verplichte zaken is het opslaan van plaintext wachtwoorden zo in de database af te raden. Onder het motto `fake it, till you make it` kun je een hardcoded wachtwoord  in je applicatie en helemaal niks in je database opslaan. Als je het wel wilt opslaan moet je het wachtwoord hashen met PHP's `password_hash` functie bij registratie van een nieuwe gebruiker. Het controleren van wachtwoord bij inloggen doe je met `password_verify` van ingevoerde wachtwoord, en de gebruiker die je op basis van de gebruikersnaam daar uit de database haalt. Deze password_verify moet je wel gebruiken in plaats van zelf in code opnieuw ingevoerde wachtwood te hashen en dan te gebruiken, omdat PHP gebruikt genereert hierbij ook nog een zogenaamde salt en gebruikt een up-to-date hashing algoritme (momenteel bcrypt) en deze opslaat bij de hashcode, waardoor deze niet altijd hetzelfde is.

## Voorkomen is beter dan genezen
Gebruik PDO met prepared statements om SQL injectie te voorkomen op pleken waar gebruikersinput in je queries gebruikt wordt. Omdat het verschil tussen de `->query()` en veiligere `->prepare()` en `->execute(params..)` combinatie niet zo groot is, is het een goede gewoonte dit overal te doen. Strikt genomen is op een plek waar geen 'variabelen' in een query een `->query()` hierbij niet nodig. Maar dit komt niet vaak voor, en kan in de toekomst veranderen, wellicht door een andere developer die hier minder alert op is. NB Frequent gemaakt fout is het gebruik van PHP's string interpolatie (`$variabele`). Maar dan is ook de tweestaps raket `->prepare()` en `->execute(params..)` alsnog niet veilig. Het is essentieel voor echte prepared statements altijd de variant met `?` of de `:veld` syntax ipv `$` syntax te gebruiken, zoals ook aangeleerd/gegeven in de lessen/lessheets.

Gebruik `htmlentities` of soortgelijke standaard PHP functies om javascript code de-actief te maken, of strip de tags en zorg dat er helemaal geen HTML in je database kan komen. Basis aanpak is dit te doen op alle plekken waar gebruiker HTML/Javascript kan invoeren. Efficient aanpak is hierbij te richten op plekken waar deze code aan andere (te exploiten) gebruikers. Op andere plekken kan een hacker typisch alleen maar zichzelf lastig vallen (er moet dus wel een 'cross site' aspect mogelijk zijn voor reeel gevaar te vormen.

## Conclusie
In het BP2 moet je XSS en SQL Injection voorkomen door het encoderen (`htmlentities`) of strippen van html tags (`strip_tags`) vanuit invoer en/of bij tonen van het scherm respectievelijk het escapen van mogelijk gevaarlijke code via gebruik PDO framework en prepared statements via PDO's `:veld` of `?` syntax. 
