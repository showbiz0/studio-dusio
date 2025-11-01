-- Insert example data into `alerts` table
INSERT INTO `alerts` (`id`, `date`, `title`, `text`, `featured`, `popup`, `popup_until`) VALUES
(1, NOW(), 'Chiusura Ufficio', 'Gentili pazienti, si informa che l\'ufficio del Dr. Rossi sarà chiuso per manutenzione straordinaria il 25 marzo. Durante questo periodo, non sarà possibile prenotare visite o consultazioni. Ci scusiamo per il disagio e vi ringraziamo per la comprensione. Per urgenze, vi preghiamo di contattare il numero di emergenza.', 0, 0, NULL),
(2, NOW(), 'Orari di Apertura Festività', 'Si avvisano i pazienti che durante il periodo delle festività pasquali, gli orari di apertura dello studio medico subiranno variazioni. Lo studio sarà aperto solo al mattino dalle 9:00 alle 12:00 nei giorni 14, 15 e 16 aprile. Vi preghiamo di organizzare di conseguenza le vostre visite. Grazie per la collaborazione.', 1, 1, '2025-04-16'),
(3, NOW(), 'Visite a Domicilio', 'Il Dr. Rossi offre ora anche il servizio di visite a domicilio per pazienti con difficoltà di mobilità. Per prenotare una visita a domicilio, vi preghiamo di contattare il nostro ufficio al numero 0123456789. Questo servizio è disponibile dal lunedì al venerdì, dalle 8:00 alle 18:00. Non esitate a chiamarci per ulteriori informazioni.', 0, 0, NULL),
(4, NOW(), 'Nuove Norme di Sicurezza', 'A causa dell\'emergenza sanitaria in corso, sono state introdotte nuove misure di sicurezza per garantire la salute di tutti i pazienti e del personale dello studio. Vi preghiamo di indossare una mascherina e di disinfettare le mani all\'ingresso. Inoltre, si raccomanda di rispettare la distanza di sicurezza di almeno un metro. Grazie per la vostra collaborazione.', 0, 0, NULL),
(5, NOW(), 'Vacanze Estive', 'Lo studio del Dr. Rossi sarà chiuso per le vacanze estive dal 1 al 31 agosto. Durante questo periodo, non saranno effettuate visite mediche. Per eventuali emergenze, vi preghiamo di rivolgervi al pronto soccorso più vicino. Buone vacanze a tutti e ci rivediamo a settembre.', 0, 0, NULL);

-- Insert example data into `reviews` table
INSERT INTO `reviews` (`id`, `date`, `name`, `surname`, `text`, `approved`) VALUES
(1, NOW(), 'John', 'Doe', 'I am very satisfied with the service provided.', 1),
(2, NOW(), 'Jane', 'Smith', 'The experience was okay, but there is room for improvement.', 0),
(3, NOW(), 'Alice', 'Johnson', 'The support team was very helpful and resolved my issue quickly.', 1),
(4, NOW(), 'Bob', 'Brown', 'I am not satisfied with the product quality.', 0),
(5, NOW(), 'Charlie', 'White', 'I highly recommend this service to everyone.', 1);
