// api.js

var API = {
  baseUrl: 'api.php',

  // Login: Übergibt username und password per POST
  login: function(username, password, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: {
        action: 'login',
        username: username,
        password: password
      },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Produkte abrufen (GET)
  getProducts: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getProducts' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Kunden abrufen (GET)
  getCustomers: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getCustomers' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Neuen Kunden speichern (POST)
  saveCustomer: function(customerData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveCustomer' }, customerData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Lieferanten abrufen (GET)
  getSuppliers: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getSuppliers' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Neuen Lieferanten speichern (POST)
  saveSupplier: function(supplierData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveSupplier' }, supplierData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Kategorien abrufen (GET)
  getCategories: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getCategories' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Neue Kategorie speichern (POST)
  saveCategory: function(categoryData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveCategory' }, categoryData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Bestellungen abrufen (GET)
  getBestellungen: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getBestellungen' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Neue Bestellung speichern (POST)
  saveBestellung: function(bestellungData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveBestellung' }, bestellungData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Aufträge abrufen (GET)
  getAuftraege: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getAuftraege' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Neuen Auftrag speichern (POST)
  saveAuftrag: function(auftragData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveAuftrag' }, auftragData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Stammdaten abrufen (GET)
  getMasterdata: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getMasterdata' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Stammdaten speichern (POST)
  saveMasterdata: function(masterData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveMasterdata' }, masterData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Retouren abrufen (GET)
  getRetoure: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getRetoure' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Neue Retoure speichern (POST)
  saveRetoure: function(retoureData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveRetoure' }, retoureData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Tagesabschluss erstellen (POST)
  createTagesabschluss: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: { action: 'createTagesabschluss' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Transaktionen abrufen (GET)
  getTransactions: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getTransactions' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Such-/Filteraktion (GET): Übergibt beliebige Parameter
  search: function(params, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: $.extend({ action: 'search' }, params),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Bericht/Statistik generieren (GET)
  generateReport: function(params, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: $.extend({ action: 'generateReport' }, params),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Benutzerverwaltung: Benutzer abrufen (GET)
  getUsers: function(callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'GET',
      data: { action: 'getUsers' },
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  },

  // Neuen Benutzer speichern (POST)
  saveUser: function(userData, callback) {
    $.ajax({
      url: this.baseUrl,
      method: 'POST',
      data: $.extend({ action: 'saveUser' }, userData),
      dataType: 'json',
      success: callback,
      error: function(xhr, status, error) {
        callback({ status: 'error', message: error });
      }
    });
  }
};

// Beispielaufrufe:
// API.login('Stl', '1234', function(response) { console.log(response); });
// API.getProducts(function(response) { if(response.status==='success') { console.log('Produkte:', response.data); } });
