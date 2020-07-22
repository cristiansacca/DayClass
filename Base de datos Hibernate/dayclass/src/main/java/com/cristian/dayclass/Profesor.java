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
/**
 *
 * @author Leandro
 */
@Entity
@Table(name="Profesor", schema="dayclass")
public class Profesor implements Serializable{
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private String apellidoProf;
    private String contraseniaProf;
    private int dniProf;
    private String emailProf;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaAltaProf;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaBajaProf;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaNacProf;
    private int legajoProf;
    private String nombreProf;
    
    @OneToMany
    private List <ContraseniaRestablecida> contraseniaRestablecida;
    @ManyToOne
    private Permiso permiso;

    public Profesor() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getApellidoProf() {
        return apellidoProf;
    }

    public void setApellidoProf(String apellidoProf) {
        this.apellidoProf = apellidoProf;
    }

    public String getContraseniaProf() {
        return contraseniaProf;
    }

    public void setContraseniaProf(String contraseniaProf) {
        this.contraseniaProf = contraseniaProf;
    }

    public int getDniProf() {
        return dniProf;
    }

    public void setDniProf(int dniProf) {
        this.dniProf = dniProf;
    }

    public String getEmailProf() {
        return emailProf;
    }

    public void setEmailProf(String emailProf) {
        this.emailProf = emailProf;
    }

    public Date getFechaAltaProf() {
        return fechaAltaProf;
    }

    public void setFechaAltaProf(Date fechaAltaProf) {
        this.fechaAltaProf = fechaAltaProf;
    }

    public Date getFechaBajaProf() {
        return fechaBajaProf;
    }

    public void setFechaBajaProf(Date fechaBajaProf) {
        this.fechaBajaProf = fechaBajaProf;
    }

    public Date getFechaNacProf() {
        return fechaNacProf;
    }

    public void setFechaNacProf(Date fechaNacProf) {
        this.fechaNacProf = fechaNacProf;
    }

    public int getLegajoProf() {
        return legajoProf;
    }

    public void setLegajoProf(int legajoProf) {
        this.legajoProf = legajoProf;
    }

    public String getNombreProf() {
        return nombreProf;
    }

    public void setNombreProf(String nombreProf) {
        this.nombreProf = nombreProf;
    }

    public Permiso getPermiso() {
        return permiso;
    }

    public void setPermiso(Permiso permiso) {
        this.permiso = permiso;
    }

    public List<ContraseniaRestablecida> getContraseniaRestablecida() {
        return contraseniaRestablecida;
    }

    public void setContraseniaRestablecida(List<ContraseniaRestablecida> contraseniaRestablecida) {
        this.contraseniaRestablecida = contraseniaRestablecida;
    }
    
}
