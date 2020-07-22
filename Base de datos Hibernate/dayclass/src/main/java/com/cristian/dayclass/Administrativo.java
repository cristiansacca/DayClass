/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package com.cristian.dayclass;
import java.io.Serializable;
import java.util.Date;
import java.util.List;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;

package com.cristian.dayclass;

/**
 *
 * @author Leandro
 */

@Entity
@Table(name="Administrativo", schema="dayclass")
public class Administrativo implements Serializable {
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private String apellidoAdm;
    private String contraseniaAdm;
    private int dniAdm;
    private String emailAdm;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaAltaAdm;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaBajaAdm;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaNacAdm;
    private int legajoAdm;
    private String nombreAdm;
    
    @OneToMany
    private List <ContraseniaRestablecida> contraseniaRestablecida;
    @ManyToOne
    private Permiso permiso;

    public Administrativo() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getApellidoAdm() {
        return apellidoAdm;
    }

    public void setApellidoAdm(String apellidoAdm) {
        this.apellidoAdm = apellidoAdm;
    }

    public String getContraseniaAdm() {
        return contraseniaAdm;
    }

    public void setContraseniaAdm(String contraseniaAdm) {
        this.contraseniaAdm = contraseniaAdm;
    }

    public int getDniAdm() {
        return dniAdm;
    }

    public void setDniAdm(int dniAdm) {
        this.dniAdm = dniAdm;
    }

    public String getEmailAdm() {
        return emailAdm;
    }

    public void setEmailAdm(String emailAdm) {
        this.emailAdm = emailAdm;
    }

    public Date getFechaAltaAdm() {
        return fechaAltaAdm;
    }

    public void setFechaAltaAdm(Date fechaAltaAdm) {
        this.fechaAltaAdm = fechaAltaAdm;
    }

    public Date getFechaBajaAdm() {
        return fechaBajaAdm;
    }

    public void setFechaBajaAdm(Date fechaBajaAdm) {
        this.fechaBajaAdm = fechaBajaAdm;
    }

    public Date getFechaNacAdm() {
        return fechaNacAdm;
    }

    public void setFechaNacAdm(Date fechaNacAdm) {
        this.fechaNacAdm = fechaNacAdm;
    }

    public int getLegajoAdm() {
        return legajoAdm;
    }

    public void setLegajoAdm(int legajoAdm) {
        this.legajoAdm = legajoAdm;
    }

    public String getNombreAdm() {
        return nombreAdm;
    }

    public void setNombreAdm(String nombreAdm) {
        this.nombreAdm = nombreAdm;
    }

    public <any> getContraseniaRestablecida() {
        return contraseniaRestablecida;
    }

    public void setContraseniaRestablecida(<any> contraseniaRestablecida) {
        this.contraseniaRestablecida = contraseniaRestablecida;
    }

    public Permiso getPermiso() {
        return permiso;
    }

    public void setPermiso(Permiso permiso) {
        this.permiso = permiso;
    }
    
    
    
}
